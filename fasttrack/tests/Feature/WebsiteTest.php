<?php

namespace Tests\Feature;

use App\Models\Enquiry;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $this->post('/contact', [
            'name' => 'Bob', 'email' => 'bob@example.com', 'topic' => 'Storage', 'message' => 'Do you store pianos?',
        ])->assertSessionHas('sent');

        $this->assertSame('Do you store pianos?', Enquiry::sole()->message);
    }
}
