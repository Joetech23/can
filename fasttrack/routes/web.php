<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

// Public website
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/services', 'services')->name('services');
    Route::get('/services/{slug}', 'service')->name('services.show');
    Route::get('/pricing', 'pricing')->name('pricing');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
});

Route::get('/quote', [QuoteController::class, 'create'])->name('quote');
Route::post('/quote', [QuoteController::class, 'store'])->middleware('throttle:10,1')->name('quote.store');
Route::get('/quote/thanks', [QuoteController::class, 'thanks'])->name('quote.thanks');
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
    Route::get('/quotes/{quote:reference}', [Admin\QuoteController::class, 'show'])->name('quotes.show');
    Route::patch('/quotes/{quote:reference}', [Admin\QuoteController::class, 'update'])->name('quotes.update');
    Route::post('/quotes/{quote:reference}/notes', [Admin\QuoteController::class, 'note'])->name('quotes.note');
    Route::get('/jobs', Admin\JobController::class)->name('jobs');
    Route::get('/customers', Admin\CustomerController::class)->name('customers');
    Route::get('/enquiries', [Admin\EnquiryController::class, 'index'])->name('enquiries.index');
    Route::patch('/enquiries/{enquiry}', [Admin\EnquiryController::class, 'update'])->name('enquiries.update');
});
