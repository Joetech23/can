<?php

namespace Tests\Feature;

use App\Models\Enquiry;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrmTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_sent_to_login(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
    }

    public function test_staff_can_log_in_and_out(): void
    {
        $user = User::factory()->create(['password' => 'secret-pass']);

        $this->post('/login', ['email' => $user->email, 'password' => 'wrong'])->assertSessionHasErrors('email');
        $this->post('/login', ['email' => $user->email, 'password' => 'secret-pass'])->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);

        $this->post('/logout')->assertRedirect(route('home'));
        $this->assertGuest();
    }

    public function test_crm_pages_render_with_data(): void
    {
        Quote::factory(15)->create();
        Enquiry::create(['name' => 'Ann', 'email' => 'ann@example.com', 'topic' => 'Storage', 'message' => 'Hi']);
        $quote = Quote::first();

        $this->actingAs(User::factory()->create());

        foreach (['/admin', '/admin/quotes', '/admin/quotes?status=booked&q=a', '/admin/quotes/'.$quote->reference, '/admin/jobs', '/admin/customers', '/admin/enquiries'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_crm_pages_render_when_empty(): void
    {
        $this->actingAs(User::factory()->create());

        foreach (['/admin', '/admin/quotes', '/admin/jobs', '/admin/customers', '/admin/enquiries'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_updating_a_quote_logs_activity(): void
    {
        $user = User::factory()->create();
        $quote = Quote::factory()->create(['status' => 'new', 'estimate' => null, 'move_date' => null]);

        $this->actingAs($user)
            ->patch('/admin/quotes/'.$quote->reference, ['status' => 'booked', 'estimate' => '640', 'move_date' => '2026-12-12'])
            ->assertSessionHas('status', 'Quote updated.');

        $quote->refresh();
        $this->assertSame('booked', $quote->status);
        $this->assertSame('640.00', $quote->estimate);
        $this->assertCount(3, $quote->activities);

        $this->actingAs($user)->post('/admin/quotes/'.$quote->reference.'/notes', ['body' => 'Called, survey booked'])->assertRedirect();
        $this->assertSame('Called, survey booked', $quote->activities()->first()->body);
    }

    public function test_staff_can_log_a_phone_lead_without_email(): void
    {
        $user = User::factory()->create(['name' => 'Sam Staff']);

        $this->actingAs($user)->get('/admin/quotes/new')->assertOk();

        $response = $this->actingAs($user)->post('/admin/quotes', [
            'name' => 'Phone Caller', 'phone' => '07700 900999', 'email' => '',
            'service' => 'home-removals', 'property_size' => '3-bed', 'from_postcode' => 'br1 1aa', 'to_postcode' => 'tn9 1aa',
            'move_date' => now()->subDay()->toDateString(), 'source' => 'phone', 'status' => 'contacted', 'estimate' => '850',
        ]);

        $quote = Quote::sole();
        $response->assertRedirect(route('admin.quotes.show', $quote));
        $this->assertNull($quote->email);
        $this->assertSame('phone', $quote->source);
        $this->assertSame('BR1 1AA', $quote->from_postcode);
        $this->assertStringContainsString('Sam Staff', $quote->activities()->first()->body);

        $this->actingAs($user)->get('/admin/quotes/'.$quote->reference)->assertOk()->assertSee('Phone call');
        $this->actingAs($user)->get('/admin/customers')->assertOk()->assertSee('Phone Caller');
    }

    public function test_related_quotes_match_on_phone_when_there_is_no_email(): void
    {
        $a = Quote::factory()->create(['email' => null, 'phone' => '07700 111111']);
        $b = Quote::factory()->create(['email' => null, 'phone' => '07700 111111']);
        Quote::factory()->create(['email' => null, 'phone' => '07700 222222']);

        $this->assertSame([$b->id], $a->relatedQuotes()->pluck('id')->all());
    }

    public function test_quotes_export_as_csv_with_formula_guard(): void
    {
        Quote::factory()->create(['name' => '=HYPERLINK("http://evil")', 'status' => 'booked']);
        Quote::factory()->create(['name' => 'Lost Lead', 'status' => 'lost']);

        $response = $this->actingAs(User::factory()->create())->get('/admin/quotes/export?status=booked');

        $response->assertOk()->assertDownload();
        $csv = $response->streamedContent();
        $this->assertStringContainsString("'=HYPERLINK", $csv);
        $this->assertStringNotContainsString('Lost Lead', $csv);
    }

    public function test_enquiries_can_be_marked_read(): void
    {
        $enquiry = Enquiry::create(['name' => 'Ann', 'email' => 'ann@example.com', 'topic' => 'Storage', 'message' => 'Hi']);

        $this->actingAs(User::factory()->create())->patch('/admin/enquiries/'.$enquiry->id)->assertRedirect();

        $this->assertNotNull($enquiry->fresh()->read_at);
    }
}
