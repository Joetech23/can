@php($rates = config('fasttrack.rates'))
<p>There is no single price for a removal, but the cost is not a mystery either. Almost every quote comes down to the same five things.</p>

<h2>1. How much you are moving</h2>
<p>Volume decides how many movers and vans you need, and how long loading takes. A studio flat might need two movers for three hours; a four-bed house needs a bigger crew and two vans for most of a day.</p>

<h2>2. How far you are going</h2>
<p>Local moves include the first {{ $rates['included_miles'] }} miles. Beyond that we charge per mile to cover fuel and drive time, so a cross-country move costs more than a move across town even with the same furniture.</p>

<h2>3. Access at both ends</h2>
<p>Stairs, lifts, long carries from the van and parking restrictions all add time. Tell us about them up front and they are built into your fixed price rather than discovered on the day.</p>

<h2>4. Extras</h2>
<p>Packing, materials, furniture dismantling, storage and cleaning are optional. Add only what you need; our <a href="{{ route('pricing') }}">pricing page</a> lists every rate.</p>

<h2>5. The date</h2>
<p>Weekends carry a {{ $rates['surcharges']['weekend'] * 100 }}% surcharge and moves booked less than {{ $rates['surcharges']['short_notice_days'] }} days ahead add {{ $rates['surcharges']['short_notice'] * 100 }}%. If your dates are flexible, a midweek move is the easiest saving.</p>

<h2>How to avoid surprises</h2>
<ul>
    <li><strong>Get a fixed price, not an hourly estimate.</strong> A survey means the quote reflects what is actually moving.</li>
    <li><strong>Declutter first.</strong> Every item you do not move is time and van space you do not pay for.</li>
    <li><strong>Check what is included.</strong> Insurance, fuel and basic dismantling should be in the price.</li>
</ul>
<p>Want a number for your move? The <a href="{{ route('quote') }}">instant quote</a> uses our real rates and shows the breakdown line by line.</p>
