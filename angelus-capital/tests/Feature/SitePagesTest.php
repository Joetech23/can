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
            'transactions' => ['transactions', 'Four Points by Sheraton'],
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

    public function test_navigation_marks_the_current_page(): void
    {
        $this->get(route('leadership'))
            ->assertOk()
            ->assertSee('aria-current="page"', false);
    }
}
