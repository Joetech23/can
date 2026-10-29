@php($ft = config('fasttrack'))
<x-legal-page title="Privacy policy" description="How FastTrack Team Logistics collects, uses and protects your personal data.">
    <p>This policy explains how {{ $ft['legal_name'] }} ("FastTrack", "we") collects and uses personal data when you use our website, request a quote or book a service. We are the data controller for this information.</p>

    <h2>Who we are</h2>
    <p>{{ $ft['legal_name'] }}@if ($ft['company_number']), company number {{ $ft['company_number'] }}@endif, {{ $ft['address'] }}. Contact us about your data at <a href="mailto:{{ $ft['email'] }}">{{ $ft['email'] }}</a>.</p>

    <h2>What we collect</h2>
    <ul>
        <li><strong>Contact details:</strong> name, email address and phone number.</li>
        <li><strong>Move details:</strong> addresses and postcodes, dates, property size, inventory, access notes and photos you send us.</li>
        <li><strong>Booking and payment records:</strong> quotes, invoices and payment status. Card details are handled by our payment provider and are not stored by us.</li>
        <li><strong>Messages:</strong> emails, contact form messages, texts and WhatsApp conversations with our team.</li>
        <li><strong>Website data:</strong> with your consent, analytics and advertising cookies (see our <a href="{{ route('legal.cookies') }}">cookie policy</a>).</li>
    </ul>

    <h2>How we use it</h2>
    <ul>
        <li>To prepare quotes, plan and carry out your move or delivery (performance of a contract).</li>
        <li>To send booking confirmations, reminders and updates by email, text or WhatsApp (performance of a contract).</li>
        <li>To take payments, keep accounts and meet tax and legal obligations (legal obligation).</li>
        <li>To ask for a review after your job and improve our service (legitimate interests).</li>
        <li>To measure and improve our website and advertising, only where you have agreed (consent).</li>
    </ul>

    <h2>Who we share it with</h2>
    <p>We share data only with providers who help us run the service: website and system hosting, email, text and WhatsApp messaging, payment processing, mapping and, with consent, analytics and advertising platforms. Each processes data under contract and only on our instructions. We never sell your data.</p>

    <h2>How long we keep it</h2>
    <p>Quote requests that do not go ahead are deleted after 24 months. Booking and financial records are kept for six years to meet accounting requirements.</p>

    <h2>Your rights</h2>
    <p>You can ask to access, correct or delete your data, object to or restrict how we use it, or ask for a copy to take elsewhere. Where we rely on consent you can withdraw it at any time. Email <a href="mailto:{{ $ft['email'] }}">{{ $ft['email'] }}</a> and we will respond within one month.</p>
    <p>If you are unhappy with how we handle your data you can complain to the Information Commissioner's Office at <a href="https://ico.org.uk" target="_blank" rel="noopener">ico.org.uk</a>.</p>
</x-legal-page>
