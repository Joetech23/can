<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Services\EnquiryHandler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(Request $request): View
    {
        return view('pages.contact', [
            'campaign' => array_filter([
                ...(array) $request->session()->get('campaign', []),
                'landing_page' => $request->session()->get('campaign_landing_page'),
                'referrer' => $request->session()->get('campaign_referrer'),
            ]),
            'selectedEnquiryType' => array_key_exists((string) $request->query('enquiry'), config('acpl.enquiry_types'))
                ? $request->query('enquiry')
                : 'advisory',
        ]);
    }

    /**
     * Accept an enquiry: route it to the right business unit, push it to the
     * CRM, then show the thank-you page (which reports the conversion).
     */
    public function store(ContactRequest $request, EnquiryHandler $enquiries): RedirectResponse
    {
        if ($request->filled('company_website')) {
            return to_route('contact.thanks');
        }

        $enquiries->handle($request->safe()->except('company_website'), $request);

        return to_route('contact.thanks')->with('lead_name', $request->string('name')->before(' ')->toString());
    }

    public function thanks(): View
    {
        return view('pages.contact-thanks');
    }
}
