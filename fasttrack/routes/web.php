<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

// Public website
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/services', 'services')->name('services');
    Route::get('/services/{slug}', 'service')->name('services.show');
    Route::get('/areas', 'areas')->name('areas');
    Route::get('/removals/{slug}', 'area')->name('areas.show');
    Route::get('/pricing', 'pricing')->name('pricing');
    Route::get('/reviews', 'reviews')->name('reviews');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/guides', 'guides')->name('guides');
    Route::get('/guides/{slug}', 'guide')->name('guides.show');
    Route::get('/privacy-policy', 'legal')->defaults('page', 'privacy')->name('legal.privacy');
    Route::get('/terms', 'legal')->defaults('page', 'terms')->name('legal.terms');
    Route::get('/cookie-policy', 'legal')->defaults('page', 'cookies')->name('legal.cookies');
});

Route::get('/sitemap.xml', function () {
    $urls = collect(['home', 'services', 'areas', 'pricing', 'reviews', 'about', 'contact', 'quote', 'track', 'faq', 'guides', 'legal.privacy', 'legal.terms', 'legal.cookies'])
        ->map(fn ($r) => route($r))
        ->merge(collect(config('fasttrack.services'))->keys()->map(fn ($slug) => route('services.show', $slug)))
        ->merge(collect(config('fasttrack.areas'))->keys()->map(fn ($slug) => route('areas.show', $slug)))
        ->merge(collect(config('fasttrack.guides'))->keys()->map(fn ($slug) => route('guides.show', $slug)));

    return response()->view('sitemap', ['urls' => $urls])->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/robots.txt', fn () => response(
    "User-agent: *\nDisallow: /admin\nDisallow: /login\nDisallow: /quote/thanks\n\nSitemap: ".route('sitemap')."\n"
)->header('Content-Type', 'text/plain'));

Route::get('/quote', [QuoteController::class, 'create'])->name('quote');
Route::post('/quote', [QuoteController::class, 'store'])->middleware('throttle:10,1')->name('quote.store');
Route::post('/quote/estimate', [QuoteController::class, 'estimate'])->middleware('throttle:60,1')->name('quote.estimate');
Route::get('/quote/thanks', [QuoteController::class, 'thanks'])->name('quote.thanks');
Route::get('/track', [TrackController::class, 'show'])->name('track');
Route::post('/track', [TrackController::class, 'lookup'])->middleware('throttle:10,1')->name('track.lookup');
Route::post('/contact', [EnquiryController::class, 'store'])->middleware('throttle:10,1')->name('contact.store');

// Staff authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:6,1');
});
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

// CRM
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', Admin\DashboardController::class)->name('dashboard');
    Route::get('/quotes', [Admin\QuoteController::class, 'index'])->name('quotes.index');
    Route::get('/quotes/new', [Admin\QuoteController::class, 'create'])->name('quotes.create');
    Route::post('/quotes', [Admin\QuoteController::class, 'store'])->name('quotes.store');
    Route::get('/quotes/export', [Admin\QuoteController::class, 'export'])->name('quotes.export');
    Route::get('/quotes/{quote:reference}', [Admin\QuoteController::class, 'show'])->name('quotes.show');
    Route::patch('/quotes/{quote:reference}', [Admin\QuoteController::class, 'update'])->name('quotes.update');
    Route::post('/quotes/{quote:reference}/notes', [Admin\QuoteController::class, 'note'])->name('quotes.note');
    Route::get('/jobs', Admin\JobController::class)->name('jobs');
    Route::get('/customers', Admin\CustomerController::class)->name('customers');
    Route::get('/enquiries', [Admin\EnquiryController::class, 'index'])->name('enquiries.index');
    Route::patch('/enquiries/{enquiry}', [Admin\EnquiryController::class, 'update'])->name('enquiries.update');
});
