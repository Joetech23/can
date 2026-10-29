<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function __invoke(Request $request): View
    {
        $search = trim((string) $request->query('q'));

        // Customers are derived from quotes, grouped by email address.
        $customers = Quote::query()
            ->selectRaw('email, max(name) as name, max(phone) as phone, count(*) as quotes, '
                ."sum(case when status in ('booked','completed') then estimate else 0 end) as spend, "
                .'max(created_at) as last_seen')
            ->when($search !== '', fn ($q) => $q->where(fn ($q) => $q->where('name', 'like', "%$search%")->orWhere('email', 'like', "%$search%")))
            ->groupBy('email')
            ->orderByDesc('last_seen')
            ->paginate(15)
            ->withQueryString();

        return view('admin.customers', ['customers' => $customers, 'search' => $search]);
    }
}
