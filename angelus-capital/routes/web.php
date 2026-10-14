<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/what-we-do', 'services')->name('services');
    Route::get('/sectors', 'sectors')->name('sectors');
    Route::get('/transactions', 'transactions')->name('transactions');
    Route::get('/leadership', 'leadership')->name('leadership');
});

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');
