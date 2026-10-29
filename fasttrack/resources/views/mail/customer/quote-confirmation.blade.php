@php($ft = config('fasttrack'))
<x-mail::message>
# Thanks, {{ Str::before($quote->name, ' ') }} — you're on the fast track.

We've received your quote request and a member of the team will be in touch **{{ $ft['response_time'] }}** to confirm your fixed price.

<x-mail::table>
| Your request | |
|:--|:--|
| Reference | **{{ $quote->reference }}** |
| Service | {{ $quote->serviceLabel() }} |
| Route | {{ $quote->from_postcode }} → {{ $quote->to_postcode }} |
| Property | {{ $quote->sizeLabel() }} |
| Move date | {{ $quote->move_date?->format('l j F Y') ?? 'To be confirmed' }} |
</x-mail::table>

**What happens next**

1. We review your route and date.
2. A quick video survey or call to confirm what's moving.
3. Your fixed price, in writing. It won't change on the day.

<x-mail::button :url="'https://wa.me/'.$ft['whatsapp'].'?text='.urlencode('Hi FastTrack, my quote reference is '.$quote->reference)" color="go">
Speed things up on WhatsApp
</x-mail::button>

Something wrong or changed? Just reply to this email or call **{{ $ft['phone'] }}**.

The FastTrack team
</x-mail::message>
