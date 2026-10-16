<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    public function test_landing_page_renders_without_site_navigation_and_is_not_indexed(): void
    {
        $this->get(route('landing'))
            ->assertOk()
            ->assertSee('Request a consultation')
            ->assertSee('noindex, follow', false)
            ->assertDontSee('aria-label="Primary"', false);
    }

    public function test_campaign_parameters_are_carried_into_the_form(): void
    {
        $this->get(route('landing', ['utm_source' => 'facebook', 'utm_campaign' => 'q4-capital', 'ignored' => 'x']))
            ->assertOk()
            ->assertSee('name="utm_source" value="facebook"', false)
            ->assertSee('name="utm_campaign" value="q4-capital"', false)
            ->assertDontSee('name="ignored"', false);
    }

    public function test_landing_enquiry_without_message_redirects_to_thank_you_and_logs_campaign(): void
    {
        Log::spy();

        $this->post(route('contact.store'), [
            'source' => 'landing',
            'name' => 'Ada Obi',
            'email' => 'ada@example.com',
            'enquiry_type' => 'capital',
            'utm_source' => 'google',
        ])->assertRedirect(route('landing.thanks'))
            ->assertSessionHas('lead_name', 'Ada');

        Log::shouldHaveReceived('info')->once()->withArgs(
            fn (string $message, array $context): bool => $context['utm_source'] === 'google' && ! array_key_exists('message', $context)
        );
    }

    public function test_thank_you_page_reports_a_conversion_only_after_a_real_submission(): void
    {
        config(['acpl.tracking.meta_pixel' => '1234567890']);

        $this->get(route('landing.thanks'))
            ->assertOk()
            ->assertSee("fbq('track', 'PageView')", false)
            ->assertDontSee("fbq('track', 'Lead')", false);

        $this->withSession(['lead_name' => 'Ada'])
            ->get(route('landing.thanks'))
            ->assertSee('Thank you, Ada.')
            ->assertSee("fbq('track', 'Lead')", false);
    }

    public function test_tracking_tags_are_absent_when_not_configured(): void
    {
        config(['acpl.tracking.meta_pixel' => null, 'acpl.tracking.google_tag' => null]);

        $this->get(route('landing'))
            ->assertDontSee('fbevents.js', false)
            ->assertDontSee('googletagmanager.com', false);
    }
}
