<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    /**
     * Accept an enquiry. There is no database yet, so enquiries are written
     * to the application log until mail delivery or storage is configured.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        if ($request->filled('company_website')) {
            return $request->isFromLandingPage()
                ? to_route('landing.thanks')
                : to_route('contact')->with('status', 'Thank you. Your enquiry has been received.');
        }

        Log::info('Website enquiry received', array_filter($request->safe()->except('company_website')));

        if ($request->isFromLandingPage()) {
            return to_route('landing.thanks')->with('lead_name', $request->string('name')->before(' ')->toString());
        }

        return to_route('contact')
            ->with('status', 'Thank you, '.$request->string('name')->before(' ').'. Your enquiry has been received and a member of our team will be in touch shortly.');
    }
}
