<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrackController extends Controller
{
    public function show(Request $request): View
    {
        return view('pages.track', [
            'quote' => Quote::find($request->session()->get('tracked')),
        ]);
    }

    /** Look a move up by reference, confirmed with one of its postcodes so references cannot be guessed. */
    public function lookup(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'reference' => ['required', 'string', 'max:20'],
            'postcode' => ['required', 'string', 'max:12'],
        ]);

        $postcode = strtoupper(preg_replace('/\s+/', '', $data['postcode']));
        $quote = Quote::where('reference', strtoupper(trim($data['reference'])))->first();
        $matches = $quote && in_array($postcode, [
            preg_replace('/\s+/', '', $quote->from_postcode),
            preg_replace('/\s+/', '', $quote->to_postcode),
        ], true);

        if (! $matches) {
            return back()->withInput()->withErrors(['reference' => 'We could not find a move with that reference and postcode. Check your confirmation email or call us.']);
        }

        $request->session()->put('tracked', $quote->id);

        return redirect()->route('track');
    }
}
