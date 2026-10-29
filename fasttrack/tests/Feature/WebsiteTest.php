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
        foreach (['/', '/services', '/services/home-removals', '/pricing', '/about', '/contact', '/quote', '/login'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_unknown_service_is_404(): void
    {
        $this->get('/services/teleportation')->assertNotFound();
    }

    public function test_quote_request_is_saved_with_a_reference(): void
    {
        Mail::fake();

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
        $this->assertSame('FT-'.($quote->id + 2400), $quote->reference);
        $this->assertSame('SE1 7PB', $quote->from_postcode);
        $this->assertSame(['packing', 'storage'], $quote->extras);
        $this->assertSame('new', $quote->status);
        $this->assertCount(1, $quote->activities);

        Mail::assertSent(NewQuoteReceived::class, fn ($mail) => $mail->hasTo(config('fasttrack.notify_email')) && $mail->hasReplyTo('ada@example.com'));
        Mail::assertSent(QuoteConfirmation::class, fn ($mail) => $mail->hasTo('ada@example.com'));
    }

    public function test_quote_is_kept_when_email_sending_fails(): void
    {
        Mail::shouldReceive('to')->andThrow(new \RuntimeException('SMTP down'));

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
        $this->get('/sitemap.xml')->assertOk()->assertSee(route('services.show', 'storage'), false);
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
