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

    public function transactions(): View
    {
        return view('pages.transactions');
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
}
