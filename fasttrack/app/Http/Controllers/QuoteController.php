<?php

namespace App\Http\Controllers;

use App\Mail\NewQuoteReceived;
use App\Mail\QuoteConfirmation;
use App\Models\Quote;
use App\Services\QuoteEstimator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class QuoteController extends Controller
{
    public function create(Request $request): View
    {
        return view('pages.quote', [
            'prefill' => $request->only('from', 'to', 'size', 'service'),
            'rates' => config('fasttrack.rates'),
        ]);
    }

    public function store(Request $request, QuoteEstimator $estimator): RedirectResponse
    {
        $data = $request->validate(Quote::rules());

        $data['from_postcode'] = strtoupper(trim($data['from_postcode']));
        $data['to_postcode'] = strtoupper(trim($data['to_postcode']));
        $data['flexible_date'] = $request->boolean('flexible_date');
        if ($data['service'] === 'pallet-delivery') {
            $data['property_size'] = 'pallet';
        }

        $estimate = $estimator->estimate($data);
        $data['distance_miles'] = $estimate['miles'];
        $data['estimate_low'] = $estimate['low'];
        $data['estimate_high'] = $estimate['high'];

        $quote = Quote::create($data);
        $quote->activities()->create(['type' => 'created', 'body' => 'Quote request received from the website.']);

        // A mail outage must never lose the lead, so failures are only reported.
        rescue(fn () => Mail::to(config('fasttrack.notify_email'))->send(new NewQuoteReceived($quote)));
        rescue(fn () => Mail::to($quote->email)->send(new QuoteConfirmation($quote)));

        // Stored (not flashed) so a late live-estimate request cannot consume it before the thanks page loads.
        $request->session()->put('quote', $quote->reference);

        return redirect()->route('quote.thanks');
    }

    /** Live price range for the quote form, recalculated as the customer fills it in. */
    public function estimate(Request $request, QuoteEstimator $estimator): JsonResponse
    {
        $data = $request->validate([
            'service' => ['required', Rule::in(array_keys(config('fasttrack.services')))],
            'property_size' => ['nullable', Rule::in(array_keys(config('fasttrack.property_sizes')))],
            'pallets' => ['nullable', 'integer', 'min:1', 'max:26'],
            'from_postcode' => ['nullable', 'string', 'max:12'],
            'to_postcode' => ['nullable', 'string', 'max:12'],
            'move_date' => ['nullable', 'date'],
            'extras' => ['array'],
            'extras.*' => [Rule::in(array_keys(config('fasttrack.extras')))],
        ]);

        return response()->json($estimator->estimate($data));
    }

    public function thanks(Request $request): View|RedirectResponse
    {
        $quote = Quote::firstWhere('reference', $request->session()->get('quote'));

        if (! $quote) {
            return redirect()->route('quote');
        }

        return view('pages.quote-thanks', ['quote' => $quote]);
    }
}
