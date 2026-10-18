<?php

namespace Tests\Feature;

use App\Mail\EnquiryReceived;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    /**
     * @return array<string, string>
     */
    private function validEnquiry(array $overrides = []): array
    {
        return [
            'name' => 'Ada Obi',
            'email' => 'ada@example.com',
            'phone' => '+234 800 000 0000',
            'organization' => 'Obi Holdings',
            'enquiry_type' => 'capital',
            'message' => 'We are raising growth capital for a new processing plant.',
            ...$overrides,
        ];
    }

    public function test_contact_page_offers_six_enquiry_types_including_e_invoice(): void
    {
        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('NRS e-invoice compliance advisory')
            ->assertSee('name="enquiry_type"', false);

        $this->assertCount(6, config('acpl.enquiry_types'));
    }

    public function test_enquiry_type_can_be_preselected_from_a_link(): void
    {
        $this->get(route('contact', ['enquiry' => 'einvoice']))
            ->assertOk()
            ->assertSee('value="einvoice" class="peer sr-only" checked', false);
    }

    public function test_valid_enquiry_is_routed_to_its_business_unit_and_shows_thank_you(): void
    {
        Mail::fake();
        Log::spy();
        config(['acpl.enquiry_routing.einvoice.email' => 'einvoice@example.com']);

        $this->post(route('contact.store'), $this->validEnquiry(['enquiry_type' => 'einvoice']))
            ->assertRedirect(route('contact.thanks'))
            ->assertSessionHas('lead_name', 'Ada');

        Mail::assertSent(EnquiryReceived::class, fn (EnquiryReceived $mail) => $mail->hasTo('einvoice@example.com')
            && $mail->hasReplyTo('ada@example.com')
            && $mail->unit === 'E-Invoice Compliance Advisory');

        Log::shouldHaveReceived('info')->once()->withArgs(
            fn (string $message, array $context): bool => str_contains($context['routed_to'], 'einvoice@example.com')
        );
    }

    public function test_units_without_their_own_mailbox_fall_back_to_the_company_email(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), $this->validEnquiry(['enquiry_type' => 'advisory']));

        Mail::assertSent(EnquiryReceived::class, fn (EnquiryReceived $mail) => $mail->hasTo(config('acpl.company.email')));
    }

    public function test_campaign_parameters_follow_the_visitor_from_landing_page_to_enquiry(): void
    {
        Mail::fake();

        $this->get(route('landing', ['utm_source' => 'newsletter', 'utm_campaign' => 'e-invoice']))->assertOk();

        $this->get(route('contact'))
            ->assertSee('name="utm_source" value="newsletter"', false)
            ->assertSee('name="utm_campaign" value="e-invoice"', false);

        $this->post(route('contact.store'), $this->validEnquiry(['utm_source' => 'newsletter', 'utm_campaign' => 'e-invoice']));

        Mail::assertSent(EnquiryReceived::class, fn (EnquiryReceived $mail) => ($mail->campaign['utm_campaign'] ?? null) === 'e-invoice');
    }

    public function test_enquiry_is_sent_to_hubspot_when_configured(): void
    {
        Mail::fake();
        Http::fake(['api.hsforms.com/*' => Http::response(['inlineMessage' => 'Thanks'])]);
        config(['acpl.hubspot.portal_id' => '123456', 'acpl.hubspot.form_guid' => 'abc-guid']);

        $this->post(route('contact.store'), $this->validEnquiry());

        Http::assertSent(fn ($request) => $request->url() === 'https://api.hsforms.com/submissions/v3/integration/submit/123456/abc-guid'
            && collect($request['fields'])->contains(fn ($field) => $field['name'] === 'email' && $field['value'] === 'ada@example.com')
            && collect($request['fields'])->contains(fn ($field) => $field['name'] === 'firstname' && $field['value'] === 'Ada'));
    }

    public function test_hubspot_failure_does_not_lose_the_enquiry(): void
    {
        Mail::fake();
        Http::fake(['api.hsforms.com/*' => Http::response(['status' => 'error'], 400)]);
        config(['acpl.hubspot.portal_id' => '123456', 'acpl.hubspot.form_guid' => 'abc-guid']);

        $this->post(route('contact.store'), $this->validEnquiry())
            ->assertRedirect(route('contact.thanks'));

        Mail::assertSent(EnquiryReceived::class);
    }

    public function test_hubspot_is_not_called_when_not_configured(): void
    {
        Mail::fake();
        Http::fake();

        $this->post(route('contact.store'), $this->validEnquiry());

        Http::assertNothingSent();
    }

    public function test_required_fields_are_validated_and_message_is_optional(): void
    {
        $this->from(route('contact'))
            ->post(route('contact.store'), ['enquiry_type' => 'not-a-type'])
            ->assertRedirect(route('contact'))
            ->assertSessionHasErrors(['name', 'email', 'enquiry_type'])
            ->assertSessionDoesntHaveErrors(['message']);
    }

    public function test_honeypot_submissions_are_silently_discarded(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), [...$this->validEnquiry(), 'company_website' => 'spam.example'])
            ->assertRedirect(route('contact.thanks'))
            ->assertSessionMissing('lead_name');

        Mail::assertNothingSent();
    }
}
