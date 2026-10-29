<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Quote;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $now = now();
        $thisMonth = Quote::where('created_at', '>=', $now->copy()->startOfMonth())->count();
        $lastMonth = Quote::whereBetween('created_at', [
            $now->copy()->subMonthNoOverflow()->startOfMonth(),
            $now->copy()->subMonthNoOverflow()->endOfMonth(),
        ])->count();

        $decided = Quote::where('created_at', '>=', $now->copy()->subDays(90))
            ->whereIn('status', ['booked', 'completed', 'lost'])->get(['status']);
        $won = $decided->whereIn('status', ['booked', 'completed'])->count();

        // Leads per week for the last eight weeks, oldest first.
        $weeks = collect(range(7, 0))->map(function (int $ago) use ($now) {
            $start = $now->copy()->startOfWeek()->subWeeks($ago);

            return [
                'label' => $start->format('j M'),
                'count' => Quote::whereBetween('created_at', [$start, $start->copy()->endOfWeek()])->count(),
            ];
        });

        return view('admin.dashboard', [
            'greeting' => match (true) {
                $now->hour < 12 => 'Good morning',
                $now->hour < 18 => 'Good afternoon',
                default => 'Good evening',
            },
            'pipelineValue' => (float) Quote::whereIn('status', Quote::OPEN)->sum('estimate'),
            'bookedValue' => (float) Quote::where('status', 'booked')->sum('estimate'),
            'completedValue' => (float) Quote::where('status', 'completed')
                ->where('updated_at', '>=', $now->copy()->startOfMonth())->sum('estimate'),
            'newLeads' => $thisMonth,
            'leadsChange' => $lastMonth ? round(($thisMonth - $lastMonth) / $lastMonth * 100, 1) : null,
            'conversion' => $decided->count() ? round($won / $decided->count() * 100, 1) : 0,
            'needsReply' => Quote::where('status', 'new')->count(),
            'unreadEnquiries' => Enquiry::whereNull('read_at')->count(),
            'statusCounts' => Quote::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status'),
            'recentQuotes' => Quote::latest()->take(6)->get(),
            'upcomingJobs' => Quote::where('status', 'booked')->whereDate('move_date', '>=', $now->toDateString())
                ->orderBy('move_date')->take(5)->get(),
            'weeks' => $weeks,
            'today' => Carbon::today(),
        ]);
    }
}
