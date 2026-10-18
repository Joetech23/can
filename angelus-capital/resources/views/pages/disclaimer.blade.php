@php($company = config('acpl.company'))

<x-legal-page title="Disclaimer" updated="18 October 2026">
    <p>The information on this website is provided by {{ $company['name'] }}@if ($company['rc_number']) ({{ $company['rc_number'] }})@endif (“ACPL”) for general information purposes only.</p>

    <h2>Not an offer or advice</h2>
    <p>Nothing on this website constitutes an offer, solicitation or recommendation to buy or sell any security, investment or financial product, or financial, investment, legal, tax or accounting advice. You should obtain professional advice tailored to your circumstances before making any decision.</p>

    <h2>Transaction credentials</h2>
    <p>Transaction credentials and experience described on this website reflect transactions and investments in which members of the ACPL leadership team have participated, including in previous roles.</p>

    <h2>No guarantee</h2>
    <p>Past performance is not a reliable indicator of future results. Investments carry risk, including the possible loss of capital. Any forward-looking statements reflect our views at the time of writing and may change without notice.</p>

    <h2>Accuracy of information</h2>
    <p>While we take care to keep the information on this website accurate and current, we make no representation or warranty as to its completeness or accuracy and accept no liability for any loss arising from reliance on it.</p>

    <h2>Third-party links</h2>
    <p>This website may link to third-party websites, which we do not control and for which we are not responsible.</p>

    <h2>Contact</h2>
    <p>If you have any questions about this disclaimer, please contact us at <a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a>.</p>
</x-legal-page>
