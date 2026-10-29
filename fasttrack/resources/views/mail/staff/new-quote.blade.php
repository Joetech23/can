<x-mail::message>
# New quote request {{ $quote->reference }}

**{{ $quote->name }}** wants a price for **{{ $quote->serviceLabel() }}**. Reply fast — the first company to respond usually wins the job.

<x-mail::table>
| | |
|:--|:--|
| Route | {{ $quote->from_postcode }} → {{ $quote->to_postcode }} |
| Property | {{ $quote->sizeLabel() }} |
| Move date | {{ $quote->move_date?->format('D j M Y') ?? 'Not given' }}{{ $quote->flexible_date ? ' (flexible)' : '' }} |
| Extras | {{ collect($quote->extras)->map(fn ($e) => config('fasttrack.extras.'.$e, $e))->implode(', ') ?: 'None' }} |
| Phone | {{ $quote->phone }} |
| Email | {{ $quote->email }} |
</x-mail::table>

@if ($quote->notes)
<x-mail::panel>
{{ $quote->notes }}
</x-mail::panel>
@endif

<x-mail::button :url="route('admin.quotes.show', $quote)">
Open in CRM
</x-mail::button>

Reply to this email to answer the customer directly.
</x-mail::message>
