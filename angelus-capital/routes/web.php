<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LaunchCheckController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/what-we-do', 'services')->name('services');
    Route::get('/sectors-and-transactions', 'sectors')->name('sectors');
    Route::get('/leadership', 'leadership')->name('leadership');
    Route::get('/leadership/{slug}', 'leader')->name('leadership.show');
    Route::get('/insights', 'insights')->name('insights');
    Route::get('/insights/{slug}', 'insight')->name('insights.show');
    Route::get('/partner', 'landing')->name('landing');
    Route::get('/privacy-policy', 'privacy')->name('privacy');
    Route::get('/disclaimer', 'disclaimer')->name('disclaimer');
});

Route::permanentRedirect('/sectors', '/sectors-and-transactions');
Route::permanentRedirect('/transactions', '/sectors-and-transactions#transactions');
Route::permanentRedirect('/partner/thank-you', '/contact/thank-you');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');
Route::get('/contact/thank-you', [ContactController::class, 'thanks'])->name('contact.thanks');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::controller(LaunchCheckController::class)->middleware('throttle:20,1')->group(function () {
    Route::get('/launch-check', 'show')->name('launch-check');
    Route::post('/launch-check/email', 'sendTestEmail')->name('launch-check.email');
    Route::post('/launch-check/crm', 'sendTestCrm')->name('launch-check.crm');
});
