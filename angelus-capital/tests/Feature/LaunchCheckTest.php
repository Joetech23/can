<?php

namespace Tests\Feature;

use App\Mail\EnquiryReceived;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class LaunchCheckTest extends TestCase
{
    public function test_launch_check_is_hidden_without_a_configured_key(): void
    {
        config(['acpl.launch_check_key' => null]);

        $this->get('/launch-check?key=anything')->assertNotFound();
    }

    public function test_launch_check_requires_the_correct_key(): void
    {
        config(['acpl.launch_check_key' => 'secret-key']);

        $this->get('/launch-check?key=wrong')->assertNotFound();
        $this->get('/launch-check')->assertNotFound();
    }

    public function test_launch_check_flags_emails_that_are_only_logged(): void
    {
        config(['acpl.launch_check_key' => 'secret-key', 'mail.default' => 'log']);

        $this->get('/launch-check?key=secret-key')
            ->assertOk()
            ->assertSee('noindex, follow', false)
            ->assertSee('enquiries are only written to the log');
    }

    public function test_test_email_is_sent_in_the_enquiry_format(): void
    {
        Mail::fake();
        config(['acpl.launch_check_key' => 'secret-key']);

        $this->post(route('launch-check.email'), ['key' => 'secret-key', 'to' => 'ops@example.com'])
            ->assertRedirect(route('launch-check', ['key' => 'secret-key']))
            ->assertSessionHas('launch_result.ok', true);

        Mail::assertSent(EnquiryReceived::class, fn (EnquiryReceived $mail) => $mail->hasTo('ops@example.com') && $mail->unit === 'Launch test');
    }

    public function test_test_lead_is_posted_to_the_crm_webhook_marked_as_a_test(): void
    {
        Http::fake(['crm.example.com/*' => Http::response(['ok' => true])]);
        config(['acpl.launch_check_key' => 'secret-key', 'acpl.crm.webhook_url' => 'https://crm.example.com/hooks/leads']);

        $this->post(route('launch-check.crm'), ['key' => 'secret-key'])
            ->assertSessionHas('launch_result.ok', true);

        Http::assertSent(fn ($request) => $request['test'] === true);
    }

    public function test_test_actions_require_the_key(): void
    {
        Mail::fake();
        config(['acpl.launch_check_key' => 'secret-key']);

        $this->post(route('launch-check.email'), ['key' => 'wrong', 'to' => 'ops@example.com'])->assertNotFound();

        Mail::assertNothingSent();
    }
}
