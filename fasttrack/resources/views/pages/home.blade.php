@php($ft = config('fasttrack'))
<x-layouts.site>
    {{-- HERO --}}
    <section class="relative overflow-hidden bg-ink-950 text-white">
        <x-speed-lines class="pointer-events-none absolute -right-24 top-0 hidden h-full text-white/[0.035] lg:block" />
        <div class="container-page relative grid items-center gap-12 pt-12 pb-16 lg:grid-cols-[1.15fr_1fr] lg:pt-20 lg:pb-24">
            <div>
                <p class="eyebrow text-go-400" x-reveal>Removals · Storage · Pallet delivery</p>
                <h1 class="mt-5 text-[2.6rem] leading-[1.02] font-bold sm:text-6xl lg:text-[4.2rem]" x-reveal="80">
                    Moving homes and businesses, on the <span class="text-go-500">fast track.</span>
                </h1>
                <p class="mt-6 max-w-xl text-lg leading-relaxed font-light text-white/70" x-reveal="160">
                    Fixed-price removals, storage and pallet delivery across {{ collect($ft['areas'])->take(3)->pluck('name')->implode(', ') }} and the UK. See your price instantly, then track every step on moving day.
                </p>

                {{-- Quote starter --}}
                <form action="{{ route('quote') }}" method="get" class="mt-8 rounded-lg border-t-4 border-go-500 bg-white p-4 text-ink-950 shadow-2xl sm:p-5" x-reveal="240">
                    <p class="label-caps text-ink-500">Instant quote</p>
                    <div class="mt-3 grid gap-3 sm:grid-cols-[1fr_1fr_auto]">
                        <label class="block">
                            <span class="sr-only">Moving from (postcode)</span>
                            <span class="flex items-center gap-2 rounded-md border border-ink-300 px-3 focus-within:border-go-500 focus-within:ring-4 focus-within:ring-go-100">
                                <x-icon name="map-pin" class="size-5 shrink-0 text-go-600" />
                                <input name="from" required placeholder="From postcode" class="w-full bg-transparent py-3 text-[15px] font-semibold uppercase placeholder:font-normal placeholder:normal-case placeholder:text-ink-400 focus:outline-none" autocomplete="postal-code">
                            </span>
                        </label>
                        <label class="block">
                            <span class="sr-only">Moving to (postcode)</span>
                            <span class="flex items-center gap-2 rounded-md border border-ink-300 px-3 focus-within:border-go-500 focus-within:ring-4 focus-within:ring-go-100">
                                <x-icon name="navigation" class="size-5 shrink-0 text-go-600" />
                                <input name="to" required placeholder="To postcode" class="w-full bg-transparent py-3 text-[15px] font-semibold uppercase placeholder:font-normal placeholder:normal-case placeholder:text-ink-400 focus:outline-none">
                            </span>
                        </label>
                        <button class="btn-go py-3.5">See my price <x-icon name="arrow-right" class="size-4" /></button>
                    </div>
                </form>

                <ul class="mt-6 flex flex-wrap gap-x-6 gap-y-2 text-sm text-white/70" x-reveal="320">
                    @foreach ($ft['trust'] as $item)
                        <li class="flex items-center gap-2"><x-icon :name="$item['icon']" class="size-4 text-go-500" /> {{ $item['label'] }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- Track my move mock-up --}}
            <div class="relative mx-auto w-full max-w-md lg:max-w-none" x-reveal="200">
                <div class="overflow-hidden rounded-lg bg-white text-ink-950 shadow-2xl ring-1 ring-white/10">
                    <div class="flex items-center justify-between bg-ink-900 px-6 py-4 text-white">
                        <div>
                            <p class="label-caps text-white/50">Track my move</p>
                            <p class="mt-0.5 text-lg font-bold">FT-2481 · Sat 14 Nov</p>
                        </div>
                        <span class="pill bg-go-500/15 text-go-300 ring-go-500/40"><span class="size-1.5 rounded-full bg-go-500 animate-pulse-dot"></span> Live</span>
                    </div>
                    <div class="h-1 bg-go-500"></div>
                    <div class="p-6">
                        <div class="rounded-md bg-ink-50 p-4">
                            <svg viewBox="0 0 320 120" class="h-28 w-full overflow-visible" aria-hidden="true">
                                <path id="lane" d="M20 95 C 90 95, 90 30, 160 30 S 240 95, 300 40" fill="none" stroke="#e3e3df" stroke-width="10" stroke-linecap="round"/>
                                <path d="M20 95 C 90 95, 90 30, 160 30 S 240 95, 300 40" fill="none" stroke="#db4d18" stroke-width="2.5" stroke-dasharray="2 10" stroke-linecap="round"/>
                                <circle cx="20" cy="95" r="7" fill="#fff" stroke="#101315" stroke-width="3"/>
                                <circle cx="300" cy="40" r="7" fill="#101315"/>
                                <g>
                                    <rect x="-15" y="-15" width="30" height="30" rx="6" fill="#db4d18"/>
                                    <g transform="translate(-9 -9) scale(.75)" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/>
                                    </g>
                                    <animateMotion dur="7s" repeatCount="indefinite" keyPoints="0;0;0.62;0.62" keyTimes="0;0.12;0.7;1" calcMode="spline" keySplines="0 0 1 1;.45 0 .25 1;0 0 1 1">
                                        <mpath href="#lane"/>
                                    </animateMotion>
                                </g>
                            </svg>
                            <div class="mt-1 flex justify-between text-xs">
                                <span><span class="block text-ink-500">From</span><span class="font-semibold">Bermondsey, SE1</span></span>
                                <span class="text-right"><span class="block text-ink-500">To</span><span class="font-semibold">Maidstone, ME15</span></span>
                            </div>
                        </div>
                        <ol class="mt-5 space-y-3.5">
                            @foreach ([['Quote accepted · deposit paid', 'Mon 2 Nov', 'done'], ['Packing complete', 'Fri 13 Nov', 'done'], ['Crew on the way', 'ETA 8:05am', 'live'], ['Delivered & signed off', 'Today', 'next']] as [$label, $when, $state])
                                <li class="flex items-center gap-3">
                                    <span @class([
                                        'grid size-7 shrink-0 place-items-center rounded-full',
                                        'bg-ink-950 text-white' => $state === 'done',
                                        'bg-go-500 text-white animate-pulse-dot' => $state === 'live',
                                        'border-2 border-ink-200 text-ink-300' => $state === 'next',
                                    ])>
                                        @if ($state === 'done') <x-icon name="check" class="size-4" /> @elseif ($state === 'live') <x-icon name="truck" class="size-3.5" /> @else <span class="size-1.5 rounded-full bg-current"></span> @endif
                                    </span>
                                    <span class="flex-1 text-sm {{ $state === 'next' ? 'text-ink-400' : 'font-semibold' }}">{{ $label }}</span>
                                    <span class="text-xs {{ $state === 'live' ? 'font-bold text-go-600' : 'text-ink-500' }}">{{ $when }}</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <div class="absolute -bottom-14 -left-4 hidden items-center gap-3 rounded-lg bg-white px-4 py-3 text-ink-950 shadow-xl animate-float sm:flex lg:-left-10">
                    <span class="grid size-10 place-items-center rounded-md bg-go-100 text-go-600"><x-icon name="pound-sterling" class="size-5" /></span>
                    <span>
                        <span class="block text-xs text-ink-500">Instant estimate</span>
                        <span class="block text-lg font-bold">£610 – £780</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- TRUST BAR --}}
    <section class="border-b border-ink-200 bg-ink-50">
        <div class="container-page grid grid-cols-2 divide-ink-200 lg:grid-cols-4 lg:divide-x">
            @foreach ([
                ['shield-check', 'Fully insured', 'Goods in transit & public liability'],
                ['pound-sterling', 'Fixed prices', 'No hidden extras on the day'],
                ['clock', '7 days a week', 'Early starts & short notice'],
                ['navigation', 'Live tracking', 'Follow your move online'],
            ] as [$icon, $title, $sub])
                <div class="flex items-center gap-4 px-2 py-6 lg:px-6">
                    <span class="grid size-11 shrink-0 place-items-center rounded-md bg-ink-950 text-white"><x-icon :name="$icon" /></span>
                    <span>
                        <span class="block font-semibold text-ink-950">{{ $title }}</span>
                        <span class="block text-sm text-ink-500">{{ $sub }}</span>
                    </span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 01 SERVICES --}}
    <section class="py-20 lg:py-28">
        <div class="container-page">
            <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                <x-section-head num="01" eyebrow="Services" title="Six services. One crew you can count on." lead="From a single pallet to a five-bed house, every job gets a plan, a fixed price and a team that turns up on time." />
                <a href="{{ route('services') }}" class="btn-ghost shrink-0">All services <x-icon name="arrow-right" class="size-4" /></a>
            </div>
            <div class="mt-12 grid gap-px overflow-hidden rounded-lg border border-ink-200 bg-ink-200 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($ft['services'] as $slug => $service)
                    <a href="{{ route('services.show', $slug) }}" class="group relative flex flex-col bg-white p-7 transition hover:bg-ink-950 sm:p-8" x-reveal="{{ ($loop->index % 3) * 70 }}">
                        <span class="absolute inset-x-0 top-0 h-1 origin-left scale-x-0 bg-go-500 transition-transform duration-300 group-hover:scale-x-100"></span>
                        <div class="flex items-start justify-between">
                            <span class="grid size-12 place-items-center rounded-md bg-ink-950 text-white transition group-hover:bg-go-600"><x-icon :name="$service['icon']" class="size-6" /></span>
                            <span class="font-condensed text-sm font-bold tracking-widest text-ink-300 transition group-hover:text-white/30">0{{ $loop->iteration }}</span>
                        </div>
                        <h3 class="mt-6 text-xl text-ink-950 transition group-hover:text-white">{{ $service['name'] }}</h3>
                        <p class="mt-2 flex-1 leading-relaxed text-ink-600 transition group-hover:text-white/65">{{ $service['summary'] }}</p>
                        <span class="mt-6 flex items-center justify-between border-t border-ink-200 pt-4 transition group-hover:border-white/10">
                            <span class="font-semibold text-ink-950 transition group-hover:text-white">{{ $service['from'] }}</span>
                            <x-icon name="arrow-right" class="size-5 text-go-600 transition group-hover:translate-x-1 group-hover:text-go-400" />
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 02 HOW IT WORKS --}}
    <section class="relative overflow-hidden bg-ink-950 py-20 text-white lg:py-28">
        <x-speed-lines class="pointer-events-none absolute -left-40 bottom-0 h-2/3 -scale-x-100 text-white/[0.03]" />
        <div class="container-page relative">
            <x-section-head num="02" eyebrow="How it works" title="Quote, confirm, track. That's it." dark />
            <ol class="mt-14 grid gap-px overflow-hidden rounded-lg bg-white/10 md:grid-cols-3">
                @foreach ($ft['steps'] as $i => $step)
                    <li class="bg-ink-950 p-8" x-reveal="{{ $i * 120 }}">
                        <span class="font-condensed text-6xl font-bold text-go-500">0{{ $i + 1 }}</span>
                        <h3 class="mt-4 text-xl">{{ $step['title'] }}</h3>
                        <p class="mt-2 leading-relaxed font-light text-white/65">{{ $step['body'] }}</p>
                    </li>
                @endforeach
            </ol>
            <div class="mt-10 flex flex-wrap gap-3">
                <a href="{{ route('quote') }}" class="btn-go">Get an instant quote <x-icon name="arrow-right" class="size-4" /></a>
                <a href="{{ route('track') }}" class="btn-line"><x-icon name="navigation" class="size-4" /> Track a move</a>
            </div>
        </div>
    </section>

    {{-- 03 INSTANT QUOTE + TRACKING --}}
    <section class="py-20 lg:py-28">
        <div class="container-page grid items-center gap-12 lg:grid-cols-2">
            <div>
                <x-section-head num="03" eyebrow="Instant quote" title="Your price on screen, not in three days." lead="Our quote form uses FastTrack's own rates for crew, vans, mileage and extras, so you see a realistic price range straight away. A quick survey turns it into a fixed price." />
                <ul class="mt-8 space-y-4">
                    @foreach (['Prices built from real crew, van and mileage rates', 'Weekend and short-notice surcharges shown up front', 'Accept your fixed quote online with a small deposit', 'Follow your move live with your reference number'] as $point)
                        <li class="flex gap-3"><span class="mt-1 grid size-5 shrink-0 place-items-center rounded-sm bg-go-500 text-white"><x-icon name="check" class="size-3.5" /></span> <span class="text-ink-700">{{ $point }}</span></li>
                    @endforeach
                </ul>
                <a href="{{ route('quote') }}" class="btn-go mt-8">Try the instant quote <x-icon name="arrow-right" class="size-4" /></a>
            </div>
            <div class="overflow-hidden rounded-lg border border-ink-200 shadow-xl shadow-ink-950/5" x-reveal="120">
                <div class="grid grid-cols-[1fr_auto] bg-ink-950 px-5 py-3 font-condensed text-xs font-bold tracking-[0.2em] text-white uppercase"><span>Example estimate</span><span>Amount</span></div>
                <dl class="divide-y divide-ink-200 text-[15px]">
                    @foreach ([['3 movers + Luton van · 5 hrs', '£460'], ['Travel · 38 miles (28 beyond included)', '£45'], ['Furniture dismantle & rebuild', '£60'], ['Boxes & materials', '£45'], ['Saturday move (+15%)', '£92']] as [$line, $amount])
                        <div class="grid grid-cols-[1fr_auto] gap-4 px-5 py-3.5"><dt class="text-ink-700">{{ $line }}</dt><dd class="font-semibold text-ink-950">{{ $amount }}</dd></div>
                    @endforeach
                </dl>
                <div class="flex items-center justify-between bg-go-100 px-5 py-5">
                    <span class="font-condensed text-sm font-bold tracking-[0.2em] text-go-700 uppercase">Your instant estimate</span>
                    <span class="text-2xl font-bold text-go-700">£630 – £805</span>
                </div>
                <p class="bg-ink-50 px-5 py-3 text-xs text-ink-500">Example only. Your estimate depends on your addresses, inventory and date.</p>
            </div>
        </div>
    </section>

    {{-- 04 AREAS --}}
    <section class="border-y border-ink-200 bg-ink-50 py-20">
        <div class="container-page grid gap-10 lg:grid-cols-[1fr_1.4fr] lg:items-center">
            <x-section-head num="04" eyebrow="Areas we cover" title="Local crews, UK-wide reach." lead="Based in the South East, moving homes and freight right across the UK." />
            <ul class="grid grid-cols-2 gap-2 sm:grid-cols-3">
                @foreach ($ft['areas'] as $slug => $area)
                    <li><a href="{{ route('areas.show', $slug) }}" class="group flex items-center justify-between rounded-md border border-ink-200 bg-white px-4 py-3 font-semibold text-ink-950 transition hover:border-ink-950">
                        <span class="flex items-center gap-2"><x-icon name="map-pin" class="size-4 text-go-600" /> {{ $area['name'] }}</span>
                        <x-icon name="arrow-right" class="size-4 text-ink-300 transition group-hover:translate-x-0.5 group-hover:text-ink-950" />
                    </a></li>
                @endforeach
                <li><a href="{{ route('areas') }}" class="flex h-full items-center justify-center rounded-md bg-ink-950 px-4 py-3 font-condensed font-bold tracking-wider text-white uppercase hover:bg-go-600">All areas</a></li>
            </ul>
        </div>
    </section>

    {{-- 05 REVIEWS --}}
    <section class="py-20 lg:py-28">
        <div class="container-page">
            <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                <x-section-head num="05" eyebrow="Reviews" title="What customers say." />
                <a href="{{ route('reviews') }}" class="btn-ghost shrink-0">All reviews <x-icon name="arrow-right" class="size-4" /></a>
            </div>
            <div class="mt-12 grid gap-5 md:grid-cols-3">
                @foreach (array_slice($ft['reviews'], 0, 3) as $review)
                    @include('partials.review-card', ['review' => $review])
                @endforeach
            </div>
        </div>
    </section>

    {{-- 06 GUIDES --}}
    <section class="border-t border-ink-200 py-20 lg:py-24">
        <div class="container-page">
            <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                <x-section-head num="06" eyebrow="Moving guides" title="Advice from the crew." />
                <a href="{{ route('guides') }}" class="btn-ghost shrink-0">All guides <x-icon name="arrow-right" class="size-4" /></a>
            </div>
            <div class="mt-12 grid gap-5 md:grid-cols-3">
                @foreach (array_slice($ft['guides'], 0, 3, true) as $slug => $guide)
                    @include('partials.guide-card', ['slug' => $slug, 'guide' => $guide])
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="bg-ink-50 py-20 lg:py-24">
        <div class="container-page grid gap-12 lg:grid-cols-[1fr_1.5fr]">
            <div>
                <x-section-head eyebrow="FAQ" title="Questions, answered." lead="Can't see yours? Call {{ $ft['phone'] }} or message us on WhatsApp." />
                <a href="{{ route('faq') }}" class="btn-ghost mt-6">All FAQs <x-icon name="arrow-right" class="size-4" /></a>
            </div>
            @include('partials.faq', ['faqs' => collect($ft['faqs'])->flatten(1)->take(5)->values()->all()])
        </div>
    </section>
</x-layouts.site>
