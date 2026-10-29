<?php

namespace App\Http\Controllers;

use App\Mail\NewQuoteReceived;
use App\Mail\QuoteConfirmation;
use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class QuoteController extends Controller
{
    public function create(Request $request): View
    {
        return view('pages.quote', [
            'prefill' => $request->only('from', 'to', 'size', 'service'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(Quote::rules());

        $data['from_postcode'] = strtoupper(trim($data['from_postcode']));
        $data['to_postcode'] = strtoupper(trim($data['to_postcode']));
        $data['flexible_date'] = $request->boolean('flexible_date');

        $quote = Quote::create($data);
        $quote->activities()->create(['type' => 'created', 'body' => 'Quote request received from the website.']);

        // A mail outage must never lose the lead, so failures are only reported.
        rescue(fn () => Mail::to(config('fasttrack.notify_email'))->send(new NewQuoteReceived($quote)));
        rescue(fn () => Mail::to($quote->email)->send(new QuoteConfirmation($quote)));

        return redirect()->route('quote.thanks')->with('quote', $quote->reference);
    }

    public function thanks(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('quote')) {
            return redirect()->route('quote');
        }

        return view('pages.quote-thanks', ['reference' => $request->session()->get('quote')]);
    }
}
