<?php

namespace App\Http\Controllers;

use App\Mail\NewEnquiryReceived;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:30'],
            'topic' => ['required', 'string', 'max:60'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        $enquiry = Enquiry::create($data);

        rescue(fn () => Mail::to(config('fasttrack.notify_email'))->send(new NewEnquiryReceived($enquiry)));

        return back()->with('sent', true);
    }
}
