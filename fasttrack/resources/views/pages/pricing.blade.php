@php
    $ft = config('fasttrack');
    $rates = $ft['rates'];
    $estimator = app(\App\Services\QuoteEstimator::class);
    // Typical local, weekday moves straight from the rate card, so this page always matches the instant quote.
    $typical = collect(['studio', '1-bed', '2-bed', '3-bed', '4-bed'])->mapWithKeys(fn ($size) => [
        $size => $estimator->estimate(['service' => 'home-removals', 'property_size' => $size, 'miles' => $rates['included_miles']]),
    ]);
@endphp
<x-layouts.site title="Pricing" description="Transparent removal prices from FastTrack's own rate card: crew rates, typical move prices, extras and surcharges.">
    <x-page-hero eyebrow="Pricing" title="Clear prices, fixed before you move." lead="These are our standard rates, the same ones the instant quote uses. Your quote is fixed after a quick survey, with no meter running on the day." :crumbs="['Pricing' => null]">
        <a href="{{ route('quote') }}" class="btn-go mt-8">Get my instant quote <x-icon name="arrow-right" class="size-4" /></a>
    </x-page-hero>

    {{-- 01 Typical prices --}}
    <section class="py-16 lg:py-24">
        <div class="container-page">
            <x-section-head num="01" eyebrow="Typical moves" title="What a local move usually costs." lead="Weekday moves within {{ $rates['included_miles'] }} miles, including crew, van and fuel. Longer distances, weekends and extras are added in your quote." />
            <div class="mt-10 grid gap-px overflow-hidden rounded-lg border border-ink-200 bg-ink-200 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ($typical as $size => $estimate)
                    @php($job = $rates['jobs'][$size])
                    <div @class(['flex flex-col p-6', 'bg-ink-950 text-white' => $size === '2-bed', 'bg-white' => $size !== '2-bed'])>
                        @if ($size === '2-bed') <span class="label-caps mb-3 self-start rounded-sm bg-go-600 px-2 py-1 text-white">Most booked</span> @endif
                        <h3 class="text-xl">{{ $ft['property_sizes'][$size] }}</h3>
                        <p class="mt-1 text-sm {{ $size === '2-bed' ? 'text-white/60' : 'text-ink-500' }}">{{ $job['crew'] }} movers · {{ $job['vans'] }} {{ Str::plural('van', $job['vans']) }} · ~{{ $job['hours'] }} hrs</p>
                        <p class="mt-6 text-3xl font-bold {{ $size === '2-bed' ? 'text-go-400' : 'text-ink-950' }}">£{{ number_format($estimate['low']) }}<span class="text-lg font-semibold {{ $size === '2-bed' ? 'text-white/60' : 'text-ink-400' }}">–{{ number_format($estimate['high']) }}</span></p>
                        <a href="{{ route('quote', ['size' => $size]) }}" class="mt-6 font-condensed text-sm font-bold tracking-wider uppercase {{ $size === '2-bed' ? 'text-white hover:text-go-400' : 'text-go-600 hover:text-go-700' }}">Get my exact price →</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 02 Rate card --}}
    <section class="border-t border-ink-200 bg-ink-50 py-16 lg:py-24">
        <div class="container-page grid gap-10 lg:grid-cols-2">
            <div>
                <x-section-head num="02" eyebrow="Rate card" title="Crew and van rates." />
                <div class="mt-8 overflow-hidden rounded-lg border border-ink-200 bg-white">
                    <table class="w-full text-left text-[15px]">
                        <thead class="bg-ink-950 font-condensed text-xs tracking-[0.2em] text-white uppercase">
                            <tr><th class="px-5 py-3 font-bold">Crew</th><th class="px-5 py-3 text-right font-bold">Per hour</th></tr>
                        </thead>
                        <tbody class="divide-y divide-ink-200">
                            @foreach ($rates['crew_hourly'] as $crew => $hourly)
                                <tr><td class="px-5 py-3.5 text-ink-700">{{ $crew }} movers + 1 van</td><td class="px-5 py-3.5 text-right font-semibold text-ink-950">£{{ $hourly }}</td></tr>
                            @endforeach
                            <tr><td class="px-5 py-3.5 text-ink-700">Each extra van</td><td class="px-5 py-3.5 text-right font-semibold text-ink-950">+£{{ $rates['extra_van_hourly'] }}</td></tr>
                            <tr><td class="px-5 py-3.5 text-ink-700">Man and van (1 helper)</td><td class="px-5 py-3.5 text-right font-semibold text-ink-950">£{{ $rates['man_and_van_hourly'] }}</td></tr>
                            <tr><td class="px-5 py-3.5 text-ink-700">Mileage beyond {{ $rates['included_miles'] }} miles</td><td class="px-5 py-3.5 text-right font-semibold text-ink-950">£{{ number_format($rates['per_mile'], 2) }}/mile</td></tr>
                            <tr><td class="px-5 py-3.5 text-ink-700">Pallet delivery</td><td class="px-5 py-3.5 text-right font-semibold text-ink-950">£{{ $rates['pallet']['base'] }} + £{{ $rates['pallet']['per_pallet'] }}/pallet</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <x-section-head eyebrow="Extras & surcharges" title="Add only what you need." class="lg:mt-0" />
                <div class="mt-8 overflow-hidden rounded-lg border border-ink-200 bg-white">
                    <table class="w-full text-left text-[15px]">
                        <thead class="bg-ink-950 font-condensed text-xs tracking-[0.2em] text-white uppercase">
                            <tr><th class="px-5 py-3 font-bold">Item</th><th class="px-5 py-3 text-right font-bold">Price</th></tr>
                        </thead>
                        <tbody class="divide-y divide-ink-200">
                            @foreach ($rates['extras'] as $extra => $price)
                                <tr><td class="px-5 py-3.5 text-ink-700">{{ $ft['extras'][$extra] }}</td><td class="px-5 py-3.5 text-right font-semibold text-ink-950">{{ $extra === 'packing' ? '+'.($price * 100).'% of move' : '£'.$price }}</td></tr>
                            @endforeach
                            <tr class="bg-go-50"><td class="px-5 py-3.5 text-ink-700">Saturday or Sunday move</td><td class="px-5 py-3.5 text-right font-semibold text-go-700">+{{ $rates['surcharges']['weekend'] * 100 }}%</td></tr>
                            <tr class="bg-go-50"><td class="px-5 py-3.5 text-ink-700">Booked less than {{ $rates['surcharges']['short_notice_days'] }} days ahead</td><td class="px-5 py-3.5 text-right font-semibold text-go-700">+{{ $rates['surcharges']['short_notice'] * 100 }}%</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- 03 What's included --}}
    <section class="py-16 lg:py-24">
        <div class="container-page grid gap-10 lg:grid-cols-[1fr_1.3fr] lg:items-start">
            <x-section-head num="03" eyebrow="Always included" title="No hidden extras." lead="Your fixed quote covers everything below. A {{ $rates['deposit_percent'] }}% deposit secures your date; the balance is due when the job is done." />
            <ul class="grid gap-3 sm:grid-cols-2">
                @foreach (['VAT, fuel and tolls within your quote', 'Goods-in-transit and public liability insurance', 'Blankets, straps and floor protection', 'Basic dismantling of beds and tables', 'Live move tracking and text updates', 'Online quote acceptance and invoices'] as $item)
                    <li class="flex items-start gap-3 rounded-lg border border-ink-200 p-4"><span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-sm bg-ink-950 text-white"><x-icon name="check" class="size-3.5" /></span><span class="font-medium text-ink-800">{{ $item }}</span></li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-cta-band />
</x-layouts.site>
