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
            return to_route('contact')->with('status', 'Thank you. Your enquiry has been received.');
        }

        Log::info('Website enquiry received', $request->safe()->except('company_website'));

        return to_route('contact')
            ->with('status', 'Thank you, '.$request->string('name')->before(' ').'. Your enquiry has been received and a member of our team will be in touch shortly.');
    }
}
