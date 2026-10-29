<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class QuoteController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $search = trim((string) $request->query('q'));

        $quotes = Quote::query()
            ->filter($status, $search)
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

    public function create(): View
    {
        return view('admin.quotes.create');
    }

    /** Log a lead that came in by phone, WhatsApp, email or referral. */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            ...Quote::rules(),
            'email' => ['nullable', 'email', 'max:160'],
            'move_date' => ['nullable', 'date'],
            'source' => ['required', Rule::in(array_keys(Quote::SOURCES))],
            'status' => ['required', Rule::in(array_keys(Quote::STATUSES))],
            'estimate' => ['nullable', 'numeric', 'min:0', 'max:1000000'],
        ]);

        $data['from_postcode'] = strtoupper(trim($data['from_postcode']));
        $data['to_postcode'] = strtoupper(trim($data['to_postcode']));
        $data['flexible_date'] = $request->boolean('flexible_date');

        $quote = Quote::create($data);
        $quote->activities()->create([
            'type' => 'created',
            'body' => 'Lead logged by '.$request->user()->name.' (source: '.Quote::SOURCES[$quote->source].').',
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('admin.quotes.show', $quote)->with('status', 'Quote '.$quote->reference.' created.');
    }

    public function export(Request $request): StreamedResponse
    {
        $quotes = Quote::query()
            ->filter($request->query('status'), trim((string) $request->query('q')))
            ->oldest()
            ->lazy();

        return response()->streamDownload(function () use ($quotes) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Reference', 'Created', 'Status', 'Source', 'Name', 'Email', 'Phone', 'Service', 'Property', 'From', 'To', 'Move date', 'Flexible', 'Extras', 'Price (GBP)', 'Notes']);
            foreach ($quotes as $q) {
                fputcsv($out, array_map(fn ($v) => static::safeCell($v), [
                    $q->reference, $q->created_at->toDateTimeString(), $q->statusLabel(), Quote::SOURCES[$q->source] ?? $q->source,
                    $q->name, $q->email, $q->phone, $q->serviceLabel(), $q->sizeLabel(), $q->from_postcode, $q->to_postcode,
                    $q->move_date?->toDateString(), $q->flexible_date ? 'Yes' : 'No', implode(', ', $q->extras ?? []), $q->estimate, $q->notes,
                ]));
            }
            fclose($out);
        }, 'fasttrack-quotes-'.now()->format('Y-m-d').'.csv', ['Content-Type' => 'text/csv']);
    }

    /** Stop spreadsheet apps treating customer-entered text as a formula. */
    private static function safeCell(mixed $value): mixed
    {
        return is_string($value) && preg_match('/^[=+\-@\t\r]/', $value) ? "'".$value : $value;
    }

    public function show(Quote $quote): View
    {
        return view('admin.quotes.show', [
            'quote' => $quote->load('activities.user'),
            'history' => $quote->relatedQuotes()->latest()->get(),
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
