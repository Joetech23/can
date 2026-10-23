<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingPageTest extends TestCase
{
    public function test_landing_page_is_focused_and_not_indexed(): void
    {
        $this->get(route('landing'))
            ->assertOk()
            ->assertSee('Book a consultation')
            ->assertSee('noindex, follow', false)
            ->assertDontSee('aria-label="Primary"', false);
    }

    public function test_landing_page_routes_visitors_to_the_contact_page_form(): void
    {
        $this->get(route('landing'))
            ->assertSee(route('contact', ['enquiry' => 'einvoice']).'#enquire', false)
            ->assertDontSee('method="POST"', false);
    }

    public function test_landing_page_questionnaire_continues_to_the_contact_form(): void
    {
        $this->get(route('landing'))
            ->assertSee('<form method="GET" action="'.route('contact').'#enquire"', false)
            ->assertSee('name="q[challenge]"', false)
            ->assertSee('High cost of capital');
    }

    public function test_landing_page_lists_platforms_in_order_and_avoids_intermediation_wording(): void
    {
        $this->get(route('landing'))
            ->assertSeeInOrder(['Advisory:', 'Capital Solutions:', 'Investments:'])
            ->assertSee('From conversation to completion.')
            ->assertDontSee('both sides of the capital equation');
    }

    public function test_thank_you_page_reports_a_conversion_only_after_a_real_submission(): void
    {
        config(['acpl.tracking.meta_pixel' => '1234567890']);

        $this->get(route('contact.thanks'))
            ->assertOk()
            ->assertSee("fbq('track', 'PageView')", false)
            ->assertDontSee("fbq('track', 'Lead')", false);

        $this->withSession(['lead_name' => 'Ada'])
            ->get(route('contact.thanks'))
            ->assertSee('Thank you, Ada.')
            ->assertSee("fbq('track', 'Lead')", false);
    }

    public function test_old_landing_thank_you_url_redirects(): void
    {
        $this->get('/partner/thank-you')->assertRedirect('/contact/thank-you');
    }

    public function test_tracking_tags_are_absent_when_not_configured(): void
    {
        config(['acpl.tracking.meta_pixel' => null, 'acpl.tracking.google_tag' => null, 'acpl.hubspot.portal_id' => null]);

        $this->get(route('landing'))
            ->assertDontSee('fbevents.js', false)
            ->assertDontSee('googletagmanager.com', false)
            ->assertDontSee('js.hs-scripts.com', false);
    }

    public function test_hubspot_tracking_code_loads_when_portal_is_configured(): void
    {
        config(['acpl.hubspot.portal_id' => '123456']);

        $this->get(route('home'))->assertSee('https://js.hs-scripts.com/123456.js', false);
    }
}
