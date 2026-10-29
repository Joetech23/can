<?php

namespace Tests\Feature;

use App\Mail\NewEnquiryReceived;
use App\Mail\NewQuoteReceived;
use App\Mail\QuoteConfirmation;
use App\Models\Enquiry;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render(): void
    {
        $urls = ['/', '/services', '/areas', '/pricing', '/reviews', '/about', '/contact', '/quote', '/track', '/faq', '/guides', '/privacy-policy', '/terms', '/cookie-policy', '/login'];
        $urls = array_merge(
            $urls,
            array_map(fn ($s) => '/services/'.$s, array_keys(config('fasttrack.services'))),
            array_map(fn ($s) => '/removals/'.$s, array_keys(config('fasttrack.areas'))),
            array_map(fn ($s) => '/guides/'.$s, array_keys(config('fasttrack.guides'))),
        );

        foreach ($urls as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_unknown_service_area_and_guide_are_404(): void
    {
        $this->get('/services/teleportation')->assertNotFound();
        $this->get('/removals/atlantis')->assertNotFound();
        $this->get('/guides/nope')->assertNotFound();
    }

    public function test_pricing_page_matches_the_estimator(): void
    {
        $estimate = app(\App\Services\QuoteEstimator::class)->estimate(['property_size' => '2-bed', 'miles' => config('fasttrack.rates.included_miles')]);

        $this->get('/pricing')->assertSee('£'.number_format($estimate['low']), false);
    }

    public function test_estimate_endpoint_returns_a_live_range(): void
    {
        $this->fakePostcodes();

        $this->postJson('/quote/estimate', [
            'service' => 'home-removals', 'property_size' => '2-bed', 'from_postcode' => 'SE1 7PB', 'to_postcode' => 'ME15 6JQ',
        ])->assertOk()->assertJsonStructure(['low', 'high', 'miles', 'lines' => [['label', 'amount']]])
            ->assertJson(fn ($json) => $json->where('miles', fn ($m) => $m > 30 && $m < 50)->etc());

        $this->postJson('/quote/estimate', ['service' => 'unknown'])->assertUnprocessable();
    }

    public function test_pallet_quote_is_stored_with_pallet_count(): void
    {
        Mail::fake();
        $this->fakePostcodes();

        $this->post('/quote', [
            'service' => 'pallet-delivery', 'property_size' => 'pallet', 'pallets' => 4,
            'from_postcode' => 'SE1 7PB', 'to_postcode' => 'ME15 6JQ',
            'name' => 'Depot Manager', 'email' => 'depot@example.com', 'phone' => '07700 900123',
        ])->assertRedirect(route('quote.thanks'));

        $quote = Quote::sole();
        $this->assertSame('pallet', $quote->property_size);
        $this->assertSame(4, $quote->pallets);
        $this->assertSame('4 pallets', $quote->sizeLabel());

        $this->post('/quote', [
            'service' => 'pallet-delivery', 'property_size' => 'pallet', 'from_postcode' => 'SE1 7PB', 'to_postcode' => 'ME15 6JQ',
            'name' => 'X', 'email' => 'x@example.com', 'phone' => '1',
        ])->assertSessionHasErrors('pallets');
    }

    public function test_customers_can_track_a_move_with_reference_and_postcode(): void
    {
        $quote = Quote::factory()->create(['status' => 'booked', 'from_postcode' => 'SE1 7PB', 'move_date' => now()->addWeek()]);

        $this->post('/track', ['reference' => strtolower($quote->reference), 'postcode' => 'se17pb'])
            ->assertRedirect(route('track'));
        $this->get('/track')->assertSee($quote->reference)->assertSee('Current stage')->assertSee('Booked');

        $this->post('/track', ['reference' => $quote->reference, 'postcode' => 'ZZ1 1ZZ'])
            ->assertSessionHasErrors('reference');
    }

    public function test_quote_request_is_saved_with_a_reference(): void
    {
        Mail::fake();
        $this->fakePostcodes();

        $response = $this->post('/quote', [
            'service' => 'home-removals',
            'from_postcode' => ' se1 7pb ',
            'to_postcode' => 'me15 6jq',
            'property_size' => '2-bed',
            'move_date' => now()->addWeek()->toDateString(),
            'extras' => ['packing', 'storage'],
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'phone' => '07700 900123',
        ]);

        $quote = Quote::sole();
        $response->assertRedirect(route('quote.thanks'))->assertSessionHas('quote', $quote->reference);

        // A live-estimate request landing before the thanks page must not lose the reference.
        $this->postJson('/quote/estimate', ['service' => 'home-removals', 'property_size' => '2-bed'])->assertOk();
        $this->assertSame('FT-'.($quote->id + 2400), $quote->reference);
        $this->assertSame('SE1 7PB', $quote->from_postcode);
        $this->assertSame(['packing', 'storage'], $quote->extras);
        $this->assertSame('new', $quote->status);
        $this->assertCount(1, $quote->activities);
        $this->assertGreaterThan(30, $quote->distance_miles);
        $this->assertGreaterThan(0, $quote->estimate_low);
        $this->assertGreaterThan($quote->estimate_low, $quote->estimate_high);

        $this->get(route('quote.thanks'))->assertSee($quote->reference)->assertSee('£'.number_format($quote->estimate_low), false);

        Mail::assertSent(NewQuoteReceived::class, fn ($mail) => $mail->hasTo(config('fasttrack.notify_email')) && $mail->hasReplyTo('ada@example.com'));
        Mail::assertSent(QuoteConfirmation::class, fn ($mail) => $mail->hasTo('ada@example.com'));
    }

    public function test_quote_is_kept_when_email_sending_fails(): void
    {
        Mail::shouldReceive('to')->andThrow(new \RuntimeException('SMTP down'));
        $this->fakePostcodes();

        $this->post('/quote', [
            'service' => 'packing', 'from_postcode' => 'SE1 7PB', 'to_postcode' => 'ME15 6JQ', 'property_size' => 'studio',
            'name' => 'Ada', 'email' => 'ada@example.com', 'phone' => '07700 900123',
        ])->assertRedirect(route('quote.thanks'));

        $this->assertSame(1, Quote::count());
    }

    public function test_emails_render(): void
    {
        $quote = Quote::factory()->create(['notes' => 'Piano', 'extras' => ['packing']]);
        $enquiry = Enquiry::create(['name' => 'Bob Smith', 'email' => 'bob@example.com', 'topic' => 'Storage', 'message' => 'Hello']);

        $this->assertStringContainsString($quote->reference, (new NewQuoteReceived($quote))->render());
        $this->assertStringContainsString($quote->reference, (new QuoteConfirmation($quote))->render());
        $this->assertStringContainsString('Hello', (new NewEnquiryReceived($enquiry))->render());
    }

    public function test_seo_endpoints(): void
    {
        $this->get('/sitemap.xml')->assertOk()
            ->assertSee(route('services.show', 'pallet-delivery'), false)
            ->assertSee(route('areas.show', 'croydon'), false)
            ->assertSee(route('guides.show', 'packing-tips'), false);
        $this->get('/robots.txt')->assertOk()->assertSee('Disallow: /admin')->assertSee('Sitemap: '.route('sitemap'));
        $this->get('/')->assertSee('"@type":"MovingCompany"', false);
        $this->get('/no-such-page')->assertNotFound()->assertSee('Wrong turn');
    }

    public function test_quote_request_is_validated(): void
    {
        $this->post('/quote', ['service' => 'nope', 'extras' => ['jetpack']])
            ->assertSessionHasErrors(['service', 'from_postcode', 'to_postcode', 'property_size', 'name', 'email', 'phone', 'extras.0']);

        $this->assertSame(0, Quote::count());
    }

    public function test_thanks_page_needs_a_submitted_quote(): void
    {
        $this->get('/quote/thanks')->assertRedirect(route('quote'));
    }

    public function test_contact_form_creates_an_enquiry(): void
    {
        Mail::fake();

        $this->post('/contact', [
            'name' => 'Bob', 'email' => 'bob@example.com', 'topic' => 'Storage', 'message' => 'Do you store pianos?',
        ])->assertSessionHas('sent');

        $this->assertSame('Do you store pianos?', Enquiry::sole()->message);
        Mail::assertSent(NewEnquiryReceived::class);
    }
}
