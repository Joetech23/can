@php($company = config('acpl.company'))

<x-legal-page title="Privacy Policy" updated="18 October 2026">
    <p>{{ $company['name'] }}@if ($company['rc_number']) ({{ $company['rc_number'] }})@endif (“ACPL”, “we”, “us”) respects your privacy. This policy explains how we collect, use and protect personal data when you visit {{ $company['website'] }} or contact us, in line with the Nigeria Data Protection Act 2023 and other applicable law.</p>

    <h2>Information we collect</h2>
    <ul>
        <li><strong>Information you give us</strong> — such as your name, email address, phone number, organization and the details of your enquiry when you complete a form or contact us by email, phone or WhatsApp.</li>
        <li><strong>Information collected automatically</strong> — such as pages visited, device and browser type, approximate location, and how you arrived at our website (for example, the campaign or link you clicked).</li>
    </ul>

    <h2>How we use it</h2>
    <ul>
        <li>To respond to your enquiry and route it to the appropriate team.</li>
        <li>To manage our relationship with you, including in our customer relationship management (CRM) system.</li>
        <li>To understand how our website and marketing campaigns perform, and to improve them.</li>
        <li>To meet our legal and regulatory obligations.</li>
    </ul>

    <h2>Cookies and analytics</h2>
    <p>We use cookies and similar technologies, which may include Google Analytics, HubSpot and the Meta Pixel, to measure website traffic and campaign effectiveness. You can control or delete cookies through your browser settings.</p>

    <h2>Sharing your information</h2>
    <p>We do not sell your personal data. We share it only with service providers who help us operate our website, communications and CRM, under appropriate safeguards, or where required by law. Some of these providers may process data outside Nigeria, in which case we take steps to ensure your data remains adequately protected.</p>

    <h2>How long we keep it</h2>
    <p>We keep personal data only for as long as necessary for the purposes described above, or as required by law.</p>

    <h2>Your rights</h2>
    <p>You may request access to, correction of, or deletion of your personal data, object to or restrict its processing, and withdraw consent at any time. You also have the right to lodge a complaint with the Nigeria Data Protection Commission.</p>

    <h2>Security</h2>
    <p>We use appropriate technical and organizational measures, including encrypted (HTTPS) connections, to protect your personal data.</p>

    <h2>Contact us</h2>
    <p>For any privacy question or request, contact us at <a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a> or {{ $company['phone'] }}, or write to us at {{ implode(', ', $company['address']) }}.</p>
</x-legal-page>
