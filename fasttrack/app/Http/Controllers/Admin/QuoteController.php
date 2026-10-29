<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class QuoteController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $search = trim((string) $request->query('q'));

        $quotes = Quote::query()
            ->when($status && isset(Quote::STATUSES[$status]), fn ($q) => $q->where('status', $status))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(fn ($q) => $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('reference', 'like', "%$search%")
                    ->orWhere('from_postcode', 'like', "%$search%")
                    ->orWhere('to_postcode', 'like', "%$search%"));
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.quotes.index', [
            'quotes' => $quotes,
            'status' => $status,
            'search' => $search,
            'counts' => Quote::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status'),
        ]);
    }

    public function show(Quote $quote): View
    {
        return view('admin.quotes.show', [
            'quote' => $quote->load('activities.user'),
            'history' => Quote::where('email', $quote->email)->whereKeyNot($quote->id)->latest()->get(),
        ]);
    }

    public function update(Request $request, Quote $quote): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(Quote::STATUSES))],
            'estimate' => ['nullable', 'numeric', 'min:0', 'max:1000000'],
            'move_date' => ['nullable', 'date'],
        ]);

        $changes = [];
        if ($data['status'] !== $quote->status) {
            $changes[] = 'Status changed from '.$quote->statusLabel().' to '.Quote::STATUSES[$data['status']]['label'].'.';
        }
        if (($data['estimate'] ?? null) != $quote->estimate) {
            $changes[] = 'Price set to £'.number_format((float) ($data['estimate'] ?? 0), 2).'.';
        }
        if (($data['move_date'] ?? null) !== $quote->move_date?->toDateString()) {
            $changes[] = 'Move date set to '.(($data['move_date'] ?? null) ? date('D j M Y', strtotime($data['move_date'])) : 'TBC').'.';
        }

        $quote->update($data);

        foreach ($changes as $change) {
            $quote->activities()->create(['type' => 'status', 'body' => $change, 'user_id' => $request->user()->id]);
        }

        return back()->with('status', $changes ? 'Quote updated.' : 'Nothing changed.');
    }

    public function note(Request $request, Quote $quote): RedirectResponse
    {
        $data = $request->validate(['body' => ['required', 'string', 'max:2000']]);

        $quote->activities()->create(['type' => 'note', 'body' => $data['body'], 'user_id' => $request->user()->id]);

        return back()->with('status', 'Note added.');
    }
}
