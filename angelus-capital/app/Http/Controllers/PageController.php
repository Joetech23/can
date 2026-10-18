<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function sectors(): View
    {
        return view('pages.sectors');
    }

    public function leadership(): View
    {
        return view('pages.leadership');
    }

    public function leader(string $slug): View
    {
        $leaders = collect(config('acpl.leadership'));
        $leader = $leaders->firstWhere('slug', $slug);

        abort_if($leader === null, 404);

        return view('pages.leader', [
            'leader' => $leader,
            'colleagues' => $leaders->where('slug', '!=', $slug)->values(),
        ]);
    }

    /**
     * Advertising landing page (the campaign destination URL). It informs and
     * then routes visitors to the contact page, where the enquiry form lives.
     */
    public function landing(): View
    {
        return view('pages.landing');
    }

    public function insights(): View
    {
        return view('pages.insights', [
            'articles' => collect(config('acpl.insights'))->sortByDesc('date')->values(),
        ]);
    }

    public function insight(string $slug): View
    {
        $articles = collect(config('acpl.insights'));
        $article = $articles->firstWhere('slug', $slug);

        abort_if($article === null, 404);

        return view('pages.insight', [
            'article' => $article,
            'related' => $articles->where('slug', '!=', $slug)->sortByDesc('date')->take(2)->values(),
        ]);
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function disclaimer(): View
    {
        return view('pages.disclaimer');
    }
}
