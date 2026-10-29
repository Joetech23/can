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

    public function test_enquiries_can_be_marked_read(): void
    {
        $enquiry = Enquiry::create(['name' => 'Ann', 'email' => 'ann@example.com', 'topic' => 'Storage', 'message' => 'Hi']);

        $this->actingAs(User::factory()->create())->patch('/admin/enquiries/'.$enquiry->id)->assertRedirect();

        $this->assertNotNull($enquiry->fresh()->read_at);
    }
}
