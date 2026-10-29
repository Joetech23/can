<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\View\View;

class JobController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.jobs', [
            'upcoming' => Quote::where('status', 'booked')
                ->whereDate('move_date', '>=', today())
                ->orderBy('move_date')
                ->get()
                ->groupBy(fn (Quote $q) => $q->move_date->toDateString()),
            'unscheduled' => Quote::where('status', 'booked')->whereNull('move_date')->latest()->get(),
            'recent' => Quote::where('status', 'completed')->latest('updated_at')->take(6)->get(),
        ]);
    }
}
