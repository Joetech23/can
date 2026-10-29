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

    public function areas(): View
    {
        return view('pages.areas');
    }

    public function area(string $slug): View
    {
        $area = config("fasttrack.areas.$slug");
        abort_unless($area, 404);

        return view('pages.area', ['slug' => $slug, 'area' => $area]);
    }

    public function pricing(): View
    {
        return view('pages.pricing');
    }

    public function reviews(): View
    {
        return view('pages.reviews');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function faq(): View
    {
        return view('pages.faq');
    }

    public function guides(): View
    {
        return view('pages.guides');
    }

    public function guide(string $slug): View
    {
        $guide = config("fasttrack.guides.$slug");
        abort_unless($guide && view()->exists("guides.$slug"), 404);

        return view('pages.guide', ['slug' => $slug, 'guide' => $guide]);
    }

    public function legal(string $page): View
    {
        return view("legal.$page");
    }
}
