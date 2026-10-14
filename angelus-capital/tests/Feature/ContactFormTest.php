<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    /**
     * @return array<string, string>
     */
    private function validEnquiry(): array
    {
        return [
            'name' => 'Ada Obi',
            'email' => 'ada@example.com',
            'phone' => '+234 800 000 0000',
            'organization' => 'Obi Holdings',
            'enquiry_type' => 'capital',
            'message' => 'We are raising growth capital for a new processing plant.',
        ];
    }

    public function test_valid_enquiry_is_accepted_and_logged(): void
    {
        Log::spy();

        $this->post(route('contact.store'), $this->validEnquiry())
            ->assertRedirect(route('contact'))
            ->assertSessionHas('status');

        Log::shouldHaveReceived('info')->once()->withArgs(
            fn (string $message, array $context): bool => $context['email'] === 'ada@example.com'
        );
    }

    public function test_required_fields_are_validated(): void
    {
        $this->from(route('contact'))
            ->post(route('contact.store'), ['enquiry_type' => 'not-a-type'])
            ->assertRedirect(route('contact'))
            ->assertSessionHasErrors(['name', 'email', 'enquiry_type', 'message']);
    }

    public function test_honeypot_submissions_are_silently_discarded(): void
    {
        Log::spy();

        $this->post(route('contact.store'), [...$this->validEnquiry(), 'company_website' => 'spam.example'])
            ->assertRedirect(route('contact'))
            ->assertSessionHas('status');

        Log::shouldNotHaveReceived('info');
    }
}
