<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SitePagesTest extends TestCase
{
    /**
     * @return array<string, array{string, string}>
     */
    public static function pages(): array
    {
        return [
            'home' => ['home', 'Creating'],
            'about' => ['about', 'Dr. Anthony Oboh'],
            'services' => ['services', 'Structuring Bankable Projects'],
            'sectors' => ['sectors', 'Fast Moving Consumer Goods'],
            'sectors-and-transactions' => ['sectors', 'Four Points by Sheraton'],
            'insights' => ['insights', 'Positioning for Africa’s Next Growth Cycle'],
            'privacy' => ['privacy', 'Nigeria Data Protection Act'],
            'disclaimer' => ['disclaimer', 'Not an offer or advice'],
            'leadership' => ['leadership', 'Dominic Oje Isunuoya'],
            'contact' => ['contact', '173 Ogudu Road'],
        ];
    }

    #[DataProvider('pages')]
    public function test_page_renders_with_its_content(string $routeName, string $expectedText): void
    {
        $response = $this->get(route($routeName));

        $response->assertOk();
        $response->assertSee($expectedText);
        $response->assertSee(config('acpl.company.name'));
    }

    public function test_leader_profile_pages_render_with_photo_and_milestones(): void
    {
        foreach (config('acpl.leadership') as $leader) {
            $this->get(route('leadership.show', $leader['slug']))
                ->assertOk()
                ->assertSee($leader['name'])
                ->assertSee($leader['milestones'][0]['title'])
                ->assertSee($leader['photo']);

            $this->assertFileExists(public_path($leader['photo']));
        }
    }

    public function test_unknown_leader_profile_returns_not_found(): void
    {
        $this->get('/leadership/not-a-real-person')->assertNotFound();
    }

    public function test_insight_articles_render_and_unknown_ones_return_not_found(): void
    {
        foreach (config('acpl.insights') as $article) {
            $this->get(route('insights.show', $article['slug']))
                ->assertOk()
                ->assertSee($article['title']);
        }

        $this->get('/insights/not-a-real-article')->assertNotFound();
    }

    public function test_old_sectors_and_transactions_urls_redirect_to_the_merged_page(): void
    {
        $this->get('/sectors')->assertStatus(301)->assertRedirect('/sectors-and-transactions');
        $this->get('/transactions')->assertStatus(301)->assertRedirect('/sectors-and-transactions#transactions');
    }

    public function test_floating_contact_dock_offers_whatsapp_and_email(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('data-dock', false)
            ->assertSee('https://wa.me/'.config('acpl.company.whatsapp'), false)
            ->assertSee('mailto:'.config('acpl.company.email'), false);
    }

    public function test_rc_number_appears_in_footer_once_configured(): void
    {
        config(['acpl.company.rc_number' => 'RC 1234567']);

        $this->get(route('home'))->assertSee('RC 1234567');
    }

    public function test_every_page_closes_with_the_profile_banner_and_its_own_call_to_action(): void
    {
        foreach (['about', 'services', 'sectors', 'leadership', 'insights'] as $page) {
            $this->get(route($page))
                ->assertOk()
                ->assertSee('Strategic Advice')
                ->assertSee('Enduring Impact.')
                ->assertSee(config("acpl.ctas.{$page}.title"));
        }
    }

    public function test_e_invoicing_is_presented_under_advisory_not_as_a_platform(): void
    {
        $this->assertNotContains('einvoice', array_column(config('acpl.platforms'), 'key'));
        $this->assertSame(['Advisory', 'Capital Solutions', 'Investments'], array_column(config('acpl.platforms'), 'title'));

        $this->get(route('home'))
            ->assertSee('Compliance Advisory – E-Invoicing')
            ->assertSee('Head Office Annex')
            ->assertDontSee('E-Invoice Compliance</a>', false);
    }

    public function test_about_page_presents_pirit_values_and_alternative_asset_positioning(): void
    {
        $this->get(route('about'))
            ->assertSee('PIRIT', false)
            ->assertSee('alternative asset firm')
            ->assertSeeInOrder(['Professionalism', 'Integrity', 'Relationships', 'Insight', 'Team Spirit']);
    }

    public function test_platforms_are_always_ordered_advisory_capital_investments(): void
    {
        $this->assertSame('Advisory. Capital. Investments.', config('acpl.company.tagline'));

        foreach (['home', 'about', 'services'] as $page) {
            $this->get(route($page))->assertSeeInOrder(['Advisory', 'Capital Solutions', 'Investments']);
        }
    }

    public function test_about_page_shows_the_three_platform_infographic(): void
    {
        $this->get(route('about'))
            ->assertSee('Advisory, Capital Solutions and Investments overlapping around ACPL')
            ->assertSee('Our three integrated platforms');
    }

    public function test_sitemap_lists_public_pages_but_not_the_ad_landing_page(): void
    {
        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml')
            ->assertSee('<loc>'.route('about').'</loc>', false)
            ->assertSee(route('leadership.show', 'dominic-isunuoya'), false)
            ->assertDontSee(route('landing'), false);
    }

    public function test_navigation_marks_the_current_page(): void
    {
        $this->get(route('leadership'))
            ->assertOk()
            ->assertSee('aria-current="page"', false);
    }
}
