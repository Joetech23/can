<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * XML sitemap for search engines (submit it in Google Search Console).
     */
    public function __invoke(): Response
    {
        $urls = collect(['home', 'about', 'services', 'sectors', 'leadership', 'insights', 'contact', 'privacy', 'disclaimer'])
            ->map(fn (string $name) => route($name))
            ->merge(collect(config('acpl.leadership'))->map(fn (array $leader) => route('leadership.show', $leader['slug'])))
            ->merge(collect(config('acpl.insights'))->map(fn (array $article) => route('insights.show', $article['slug'])));

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
