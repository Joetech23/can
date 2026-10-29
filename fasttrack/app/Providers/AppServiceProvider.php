<?php

namespace App\Providers;

use App\Models\Enquiry;
use App\Models\Quote;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Counters shown in the CRM sidebar and top bar on every page.
        View::composer('components.layouts.admin', function ($view) {
            $view->with([
                'newQuotes' => Quote::where('status', 'new')->count(),
                'unreadEnquiries' => Enquiry::whereNull('read_at')->count(),
                'pipeline' => (float) Quote::whereIn('status', Quote::OPEN)->sum('estimate'),
            ]);
        });
    }
}
