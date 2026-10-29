@php($ft = config('fasttrack'))
{{-- PLACEHOLDER prices: replace the guide figures below with FastTrack's confirmed rates. --}}
<x-layouts.site title="Pricing" description="Transparent removal prices. Typical costs for flats, houses and offices, with fixed quotes after a free survey.">
    <x-page-hero eyebrow="Pricing" title="Honest prices, fixed before you move." lead="Every move is different, so these are typical starting points. Your quote is fixed after a free video survey, with no meter running on the day." />

    @php($plans = [
        ['name' => 'Small move', 'size' => 'Studio or 1-bed flat', 'price' => '£295', 'crew' => '2 movers · 1 Luton van', 'features' => ['Up to 5 hours', 'Blankets & straps', 'Basic dismantling', 'Goods-in-transit cover'], 'featured' => false],
        ['name' => 'Family move', 'size' => '2–3 bedroom home', 'price' => '£640', 'crew' => '3 movers · 1 large van', 'features' => ['Full day', 'Furniture wrapped & protected', 'Dismantle & rebuild', 'Wardrobe cartons on the day', 'Dedicated move coordinator'], 'featured' => true],
        ['name' => 'Large home', 'size' => '4+ bedrooms', 'price' => '£1,150', 'crew' => '4–6 movers · 2 vans', 'features' => ['One or two-day move', 'Everything in Family', 'Packing options', 'Storage options'], 'featured' => false],
    ])

    <section class="py-16 lg:py-24">
        <div class="container-page">
            <div class="grid gap-5 lg:grid-cols-3">
                @foreach ($plans as $plan)
                    <div @class(['relative flex flex-col rounded-3xl p-8', 'bg-ink-950 text-white shadow-2xl shadow-ink-900/30 lg:-mt-4 lg:mb-4' => $plan['featured'], 'card' => ! $plan['featured']]) x-reveal="{{ $loop->index * 100 }}">
                        @if ($plan['featured'])
                            <span class="absolute -top-3 left-8 rounded-full bg-go-400 px-3 py-1 text-xs font-bold text-ink-950">Most booked</span>
                        @endif
                        <h2 class="text-xl font-bold {{ $plan['featured'] ? 'text-white' : 'text-ink-950' }}">{{ $plan['name'] }}</h2>
                        <p class="mt-1 text-sm {{ $plan['featured'] ? 'text-white/60' : 'text-ink-500' }}">{{ $plan['size'] }}</p>
                        <p class="mt-6 flex items-baseline gap-2">
                            <span class="text-sm {{ $plan['featured'] ? 'text-white/60' : 'text-ink-500' }}">from</span>
                            <span class="font-display text-5xl font-extrabold {{ $plan['featured'] ? 'text-go-400' : 'text-ink-950' }}">{{ $plan['price'] }}</span>
                        </p>
                        <p class="mt-2 text-sm font-medium {{ $plan['featured'] ? 'text-white/80' : 'text-ink-700' }}">{{ $plan['crew'] }}</p>
                        <ul class="mt-6 flex-1 space-y-3 border-t pt-6 {{ $plan['featured'] ? 'border-white/10' : 'border-ink-100' }}">
                            @foreach ($plan['features'] as $f)
                                <li class="flex gap-2 text-sm {{ $plan['featured'] ? 'text-white/85' : 'text-ink-700' }}"><x-icon name="check" class="mt-0.5 size-4 shrink-0 {{ $plan['featured'] ? 'text-go-400' : 'text-go-600' }}" /> {{ $f }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('quote', ['size' => ['Small move' => '1-bed', 'Family move' => '2-bed', 'Large home' => '4-bed'][$plan['name']]]) }}" class="{{ $plan['featured'] ? 'btn-go' : 'btn-ink' }} mt-8 w-full">Get my exact price</a>
                    </div>
                @endforeach
            </div>

            <div class="mt-16 grid gap-5 md:grid-cols-2">
                <div class="card p-8">
                    <h2 class="text-2xl font-bold text-ink-950">Add-ons</h2>
                    <dl class="mt-6 divide-y divide-ink-100">
                        @foreach ($ft['services'] as $slug => $service)
                            @continue(in_array($slug, ['home-removals', 'office-removals']))
                            <div class="flex items-center justify-between py-3 text-sm">
                                <dt class="flex items-center gap-2 font-medium text-ink-800"><x-icon :name="$service['icon']" class="size-4 text-go-700" /> {{ $service['name'] }}</dt>
                                <dd class="font-semibold text-ink-950">{{ $service['from'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
                <div class="rounded-3xl bg-go-100 p-8 ring-1 ring-go-200">
                    <h2 class="text-2xl font-bold text-ink-950">What affects your price</h2>
                    <ul class="mt-6 space-y-4">
                        @foreach (['Volume' => 'How much furniture and how many boxes.', 'Distance' => 'Miles between addresses and any tolls or ferries.', 'Access' => 'Stairs, lifts, parking and long carries.', 'Date' => 'Fridays and month-ends book up first.'] as $k => $v)
                            <li class="flex gap-3">
                                <span class="grid size-8 shrink-0 place-items-center rounded-full bg-ink-950 text-go-400"><x-icon name="check" class="size-4" /></span>
                                <span><span class="font-semibold text-ink-950">{{ $k }}.</span> <span class="text-ink-700">{{ $v }}</span></span>
                            </li>
                        @endforeach
                    </ul>
                    <p class="mt-6 text-sm font-medium text-ink-700">No hidden extras: VAT, fuel and insurance are included in your quote.</p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.site>
