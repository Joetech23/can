@php($ft = config('fasttrack'))
@php($rates = $ft['rates'])
<x-legal-page title="Terms & conditions" description="The terms that apply to quotes and bookings with FastTrack Team Logistics.">
    <p>These terms apply to quotes, bookings and services provided by {{ $ft['legal_name'] }}. By accepting a quote you agree to them.</p>

    <h2>1. Quotes</h2>
    <p>Online estimates are a guide based on our standard rates. A quote becomes fixed once confirmed in writing after a survey. Fixed quotes are valid for 30 days and are based on the inventory, addresses, access and date you have given us.</p>

    <h2>2. Booking and payment</h2>
    <p>Your booking is confirmed when you accept the quote and pay a {{ $rates['deposit_percent'] }}% deposit. The balance is due on completion of the job unless agreed otherwise. Storage is billed monthly in advance.</p>

    <h2>3. Changes and cancellations</h2>
    <p>If the job changes (extra items, different addresses, access not as described) we will agree any price change with you before continuing. You can cancel or move your date free of charge up to 7 days before the job; within 7 days the deposit is non-refundable.</p>

    <h2>4. Your responsibilities</h2>
    <ul>
        <li>Make sure we have legal parking and safe access at both addresses.</li>
        <li>Keep cash, jewellery, documents, medication and other valuables with you.</li>
        <li>Tell us about hazardous items; we cannot carry gas bottles, fuels, chemicals or firearms.</li>
        <li>Be present, or have someone present, at collection and delivery.</li>
    </ul>

    <h2>5. Insurance and liability</h2>
    <p>Every job includes goods-in-transit and public liability cover. Our liability for loss or damage is limited to the cover stated on your quote, unless caused by our negligence. Items packed by you are covered for damage only where the box itself shows external damage. Please note any damage on the job sheet and tell us in writing within 7 days.</p>

    <h2>6. Delays</h2>
    <p>We will always try to keep to the agreed time. We are not liable for delays caused by events outside our control, such as traffic incidents, severe weather or delays in your property chain. Waiting time caused by key release may be charged at our hourly rate after the first hour.</p>

    <h2>7. Complaints</h2>
    <p>If something is not right, contact us at <a href="mailto:{{ $ft['email'] }}">{{ $ft['email'] }}</a> or {{ $ft['phone'] }}. We aim to resolve complaints within 14 days.</p>

    <h2>8. Law</h2>
    <p>These terms are governed by the law of England and Wales. Nothing in them affects your statutory rights as a consumer.</p>
</x-legal-page>
