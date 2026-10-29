<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function service(string $slug): View
    {
        $service = config("fasttrack.services.$slug");
        abort_unless($service, 404);

        return view('pages.service', ['slug' => $slug, 'service' => $service]);
    }

    public function pricing(): View
    {
        return view('pages.pricing');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }
}
