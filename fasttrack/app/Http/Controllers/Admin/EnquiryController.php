<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    public function index(): View
    {
        return view('admin.enquiries', [
            'enquiries' => Enquiry::orderByRaw('read_at is not null')->latest()->paginate(15),
        ]);
    }

    public function update(Enquiry $enquiry): RedirectResponse
    {
        $enquiry->update(['read_at' => $enquiry->read_at ? null : now()]);

        return back();
    }
}
