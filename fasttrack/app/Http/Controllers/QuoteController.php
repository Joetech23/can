<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $data = $request->validate([
            'service' => ['required', Rule::in(array_keys(config('fasttrack.services')))],
            'from_postcode' => ['required', 'string', 'max:12'],
            'to_postcode' => ['required', 'string', 'max:12'],
            'property_size' => ['required', Rule::in(array_keys(config('fasttrack.property_sizes')))],
            'move_date' => ['nullable', 'date', 'after_or_equal:today'],
            'flexible_date' => ['boolean'],
            'extras' => ['array'],
            'extras.*' => [Rule::in(array_keys(config('fasttrack.extras')))],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:30'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $data['from_postcode'] = strtoupper(trim($data['from_postcode']));
        $data['to_postcode'] = strtoupper(trim($data['to_postcode']));
        $data['flexible_date'] = $request->boolean('flexible_date');

        $quote = Quote::create($data);
        $quote->activities()->create(['type' => 'created', 'body' => 'Quote request received from the website.']);

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
