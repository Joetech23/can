@php($ft = config('fasttrack'))
<x-layouts.site>
    {{-- HERO --}}
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute -top-32 -right-32 size-[640px] rounded-full bg-go-200/60 blur-3xl"></div>
            <div class="absolute top-40 -left-40 size-[420px] rounded-full bg-ink-100 blur-3xl"></div>
            <svg class="absolute inset-0 h-full w-full opacity-[0.35]" aria-hidden="true"><defs><pattern id="grid" width="48" height="48" patternUnits="userSpaceOnUse"><path d="M48 0H0V48" fill="none" stroke="#c6d1e8" stroke-width=".6"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)" style="mask-image:radial-gradient(ellipse at 70% 20%,#000 20%,transparent 70%)"/></svg>
        </div>

        <div class="container-page grid items-center gap-14 pt-10 pb-20 lg:grid-cols-[1.1fr_1fr] lg:pt-16 lg:pb-28">
            <div>
                <p class="eyebrow" x-reveal><span class="h-px w-6 bg-go-600"></span> Removals · Packing · Storage</p>
                <h1 class="mt-5 text-[2.75rem] leading-[1.02] font-extrabold text-ink-950 sm:text-6xl lg:text-[4.4rem]" x-reveal="80">
                    Your move,<br> on the
                    <span class="relative inline-block whitespace-nowrap">
                        <span class="relative z-10">fast track.</span>
                        <svg class="absolute -bottom-1 left-0 z-0 h-5 w-full text-go-400 sm:h-6" viewBox="0 0 300 24" preserveAspectRatio="none" aria-hidden="true"><path d="M4 16c60-10 140-12 292-6" stroke="currentColor" stroke-width="12" fill="none" stroke-linecap="round"/></svg>
                    </span>
                </h1>
                <p class="mt-6 max-w-xl text-lg leading-relaxed text-ink-600" x-reveal="160">
                    Fixed-price home and office moves across {{ implode(', ', array_slice($ft['areas'], 0, 3)) }} and the UK. Careful crews, on-time arrival and live updates from first box to last.
                </p>

                {{-- Quote starter: two fields up front, the rest on the next page. --}}
                <form action="{{ route('quote') }}" method="get" class="mt-8 rounded-3xl border border-ink-100 bg-white p-2 shadow-xl shadow-ink-900/5" x-reveal="240">
                    <div class="grid gap-2 sm:grid-cols-[1fr_1fr_auto]">
                        <label class="flex items-center gap-3 rounded-2xl bg-ink-50 px-4 py-3 focus-within:ring-2 focus-within:ring-go-400">
                            <x-icon name="map-pin" class="size-5 shrink-0 text-go-700" />
                            <span class="w-full">
                                <span class="block text-[11px] font-bold tracking-wider text-ink-500 uppercase">Moving from</span>
                                <input name="from" required placeholder="e.g. SE1 7PB" class="w-full bg-transparent text-[15px] font-semibold text-ink-950 placeholder:font-normal placeholder:text-ink-400 focus:outline-none" autocomplete="postal-code">
                            </span>
                        </label>
                        <label class="flex items-center gap-3 rounded-2xl bg-ink-50 px-4 py-3 focus-within:ring-2 focus-within:ring-go-400">
                            <x-icon name="route" class="size-5 shrink-0 text-go-700" />
                            <span class="w-full">
                                <span class="block text-[11px] font-bold tracking-wider text-ink-500 uppercase">Moving to</span>
                                <input name="to" required placeholder="e.g. ME15 6JQ" class="w-full bg-transparent text-[15px] font-semibold text-ink-950 placeholder:font-normal placeholder:text-ink-400 focus:outline-none">
                            </span>
                        </label>
                        <button class="btn-go rounded-2xl px-6 py-4 text-[15px]">Get my price <x-icon name="arrow-right" class="size-4" /></button>
                    </div>
                </form>

                <ul class="mt-6 flex flex-wrap gap-2" x-reveal="320">
                    @foreach ($ft['trust'] as $item)
                        <li class="chip"><x-icon name="check" class="size-4 text-go-600" /> {{ $item['label'] }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- Live move tracker mock-up --}}
            <div class="relative mx-auto w-full max-w-md lg:max-w-none" x-reveal="200">
                <div class="relative rounded-[2rem] bg-ink-950 p-6 text-white shadow-2xl shadow-ink-900/30 ring-1 ring-white/10 sm:p-7">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold tracking-widest text-white/45 uppercase">Your move</p>
                            <p class="mt-1 font-display text-xl font-bold">FT-2481 · Sat 14 Nov</p>
                        </div>
                        <span class="pill bg-go-400/15 text-go-300 ring-go-400/30"><span class="size-1.5 rounded-full bg-go-400 animate-pulse-dot"></span> Live</span>
                    </div>

                    <div class="relative mt-6 rounded-2xl bg-ink-900 p-4 ring-1 ring-white/5">
                        <svg viewBox="0 0 320 120" class="h-28 w-full overflow-visible" aria-hidden="true">
                            <path id="lane" d="M20 95 C 90 95, 90 30, 160 30 S 240 95, 300 40" fill="none" stroke="#263559" stroke-width="10" stroke-linecap="round"/>
                            <path d="M20 95 C 90 95, 90 30, 160 30 S 240 95, 300 40" fill="none" stroke="#b9ec2f" stroke-width="2.5" stroke-dasharray="2 10" stroke-linecap="round"/>
                            <circle cx="20" cy="95" r="7" fill="#0d1733" stroke="#b9ec2f" stroke-width="3"/>
                            <circle cx="300" cy="40" r="7" fill="#b9ec2f"/>
                            {{-- Van drives along the lane; SMIL keeps it on the path at any size. --}}
                            <g>
                                <rect x="-15" y="-15" width="30" height="30" rx="9" fill="#b9ec2f"/>
                                <g transform="translate(-9 -9) scale(.75)" fill="none" stroke="#070e22" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/>
                                </g>
                                <animateMotion dur="7s" repeatCount="indefinite" keyPoints="0;0;0.62;0.62" keyTimes="0;0.12;0.7;1" calcMode="spline" keySplines="0 0 1 1;.45 0 .25 1;0 0 1 1">
                                    <mpath href="#lane"/>
                                </animateMotion>
                            </g>
                        </svg>
                        <div class="mt-1 flex justify-between text-xs">
                            <span><span class="block text-white/45">From</span><span class="font-semibold">Bermondsey, SE1</span></span>
                            <span class="text-right"><span class="block text-white/45">To</span><span class="font-semibold">Maidstone, ME15</span></span>
                        </div>
                    </div>

                    <ol class="mt-6 space-y-4">
                        @foreach ([['Booked & fixed price agreed', 'Mon 2 Nov', 'done'], ['Packing complete', 'Fri 13 Nov', 'done'], ['Crew on the way', 'ETA 8:05am', 'live'], ['Delivered & rebuilt', 'Today', 'next']] as [$label, $when, $state])
                            <li class="flex items-center gap-3">
                                <span @class([
                                    'grid size-7 shrink-0 place-items-center rounded-full',
                                    'bg-go-400 text-ink-950' => $state === 'done',
                                    'bg-go-400/20 text-go-300 ring-2 ring-go-400 animate-pulse-dot' => $state === 'live',
                                    'bg-white/5 text-white/40 ring-1 ring-white/10' => $state === 'next',
                                ])>
                                    @if ($state === 'done') <x-icon name="check" class="size-4" /> @elseif ($state === 'live') <x-icon name="truck" class="size-3.5" /> @else <span class="size-1.5 rounded-full bg-current"></span> @endif
                                </span>
                                <span class="flex-1 text-sm {{ $state === 'next' ? 'text-white/45' : 'font-medium' }}">{{ $label }}</span>
                                <span class="text-xs {{ $state === 'live' ? 'font-semibold text-go-300' : 'text-white/45' }}">{{ $when }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>

                <div class="absolute top-[38%] -left-4 hidden rounded-2xl bg-white px-4 py-3 shadow-xl ring-1 ring-ink-100 animate-float sm:block lg:-left-12">
                    <p class="text-[11px] font-semibold text-ink-500">Fixed price</p>
                    <p class="font-display text-xl font-bold text-ink-950">£640.00</p>
                </div>
                <div class="absolute -right-3 -bottom-6 hidden items-center gap-3 rounded-2xl bg-white px-4 py-3 shadow-xl ring-1 ring-ink-100 animate-float [animation-delay:1.5s] sm:flex lg:-right-8">
                    <span class="grid size-9 place-items-center rounded-full bg-go-100 text-go-800"><x-icon name="message-circle" class="size-4" /></span>
                    <span>
                        <span class="block text-sm font-semibold text-ink-950">“Crew is 10 mins away”</span>
                        <span class="block text-xs text-ink-500">Text update · 7:55am</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- TRUST BAR --}}
    <section class="border-y border-ink-100 bg-ink-50/60">
        <div class="container-page grid grid-cols-2 gap-6 py-8 lg:grid-cols-4">
            @foreach ($ft['trust'] as $i => $item)
                <div class="flex items-center gap-3" x-reveal="{{ $i * 80 }}">
                    <span class="grid size-11 shrink-0 place-items-center rounded-2xl bg-white text-go-700 ring-1 ring-ink-100"><x-icon :name="$item['icon']" /></span>
                    <span class="text-sm font-semibold text-ink-900">{{ $item['label'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- SERVICES --}}
    <section class="py-20 lg:py-28">
        <div class="container-page">
            <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                <div class="max-w-2xl">
                    <p class="eyebrow"><span class="h-px w-6 bg-go-600"></span> What we move</p>
                    <h2 class="mt-4 text-4xl font-bold text-ink-950 sm:text-5xl">One crew for the whole move.</h2>
                    <p class="mt-4 text-lg text-ink-600">Book the van, the packing, the storage and the clear-out in one go, with one point of contact.</p>
                </div>
                <a href="{{ route('services') }}" class="btn-ghost shrink-0">All services <x-icon name="arrow-right" class="size-4" /></a>
            </div>

            <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($ft['services'] as $slug => $service)
                    <a href="{{ route('services.show', $slug) }}" class="group relative flex flex-col rounded-3xl border border-ink-100 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-go-300 hover:shadow-xl hover:shadow-go-900/5" x-reveal="{{ ($loop->index % 4) * 70 }}">
                        <span class="grid size-12 place-items-center rounded-2xl bg-go-100 text-go-800 ring-1 ring-go-200 transition group-hover:bg-go-400 group-hover:text-ink-950">
                            <x-icon :name="$service['icon']" class="size-6" />
                        </span>
                        <h3 class="mt-6 text-lg font-bold text-ink-950">{{ $service['name'] }}</h3>
                        <p class="mt-2 flex-1 text-[15px] leading-relaxed text-ink-600">{{ $service['summary'] }}</p>
                        <span class="mt-5 flex items-center justify-between text-sm">
                            <span class="font-semibold text-ink-900">{{ $service['from'] }}</span>
                            <span class="grid size-8 place-items-center rounded-full bg-ink-50 text-ink-700 transition group-hover:bg-ink-950 group-hover:text-go-400"><x-icon name="arrow-right" class="size-4" /></span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section class="relative overflow-hidden bg-ink-950 py-20 text-white lg:py-28">
        <div class="pointer-events-none absolute -bottom-40 -left-20 size-[520px] rounded-full bg-go-400/10 blur-3xl"></div>
        <div class="container-page relative">
            <div class="mx-auto max-w-2xl text-center">
                <p class="eyebrow text-go-400"><span class="h-px w-6 bg-go-400"></span> How it works <span class="h-px w-6 bg-go-400"></span></p>
                <h2 class="mt-4 text-4xl font-bold sm:text-5xl">Three steps. No surprises.</h2>
            </div>
            <ol class="relative mt-14 grid gap-6 md:grid-cols-3">
                <div class="absolute top-10 right-[16%] left-[16%] hidden h-px border-t-2 border-dashed border-white/15 md:block" aria-hidden="true"></div>
                @foreach ($ft['steps'] as $i => $step)
                    <li class="relative rounded-3xl bg-white/[0.04] p-7 ring-1 ring-white/10 backdrop-blur" x-reveal="{{ $i * 120 }}">
                        <span class="relative grid size-14 place-items-center rounded-2xl bg-go-400 font-display text-2xl font-extrabold text-ink-950 shadow-[0_0_0_8px_#070e22]">{{ $i + 1 }}</span>
                        <h3 class="mt-6 text-xl font-bold">{{ $step['title'] }}</h3>
                        <p class="mt-2 leading-relaxed text-white/65">{{ $step['body'] }}</p>
                    </li>
                @endforeach
            </ol>
            <div class="mt-12 text-center">
                <a href="{{ route('quote') }}" class="btn-go">Start step one <x-icon name="arrow-right" class="size-4" /></a>
            </div>
        </div>
    </section>

    {{-- WHY FASTTRACK (bento) --}}
    <section class="py-20 lg:py-28">
        <div class="container-page">
            <div class="max-w-2xl">
                <p class="eyebrow"><span class="h-px w-6 bg-go-600"></span> Why FastTrack</p>
                <h2 class="mt-4 text-4xl font-bold text-ink-950 sm:text-5xl">Built around the three questions everyone asks.</h2>
            </div>
            <div class="mt-12 grid gap-4 lg:grid-cols-3 lg:grid-rows-2">
                <div class="card relative overflow-hidden p-8 lg:row-span-2" x-reveal>
                    <span class="grid size-12 place-items-center rounded-2xl bg-ink-950 text-go-400"><x-icon name="pound-sterling" class="size-6" /></span>
                    <h3 class="mt-6 text-2xl font-bold text-ink-950">“How much?”</h3>
                    <p class="mt-3 leading-relaxed text-ink-600">A fixed price after a quick video survey. No hourly meter running on the day, no fuel surcharge, no stair fees.</p>
                    <div class="mt-8 space-y-3 rounded-2xl bg-ink-50 p-5">
                        @foreach ([['2-bed flat · SE1 → ME15', '£640'], ['Packing (fragile only)', '£120'], ['Furniture dismantle', 'Included']] as [$line, $price])
                            <div class="flex justify-between text-sm"><span class="text-ink-600">{{ $line }}</span><span class="font-semibold text-ink-950">{{ $price }}</span></div>
                        @endforeach
                        <div class="flex justify-between border-t border-ink-200 pt-3"><span class="font-semibold text-ink-950">Your fixed price</span><span class="font-display text-xl font-bold text-ink-950">£760</span></div>
                    </div>
                    <p class="mt-3 text-xs text-ink-500">Example only. Your price depends on your inventory and addresses.</p>
                </div>
                <div class="card p-8 lg:col-span-2" x-reveal="100">
                    <div class="flex flex-col gap-6 sm:flex-row sm:items-center">
                        <div class="flex-1">
                            <span class="grid size-12 place-items-center rounded-2xl bg-go-100 text-go-800"><x-icon name="calendar" class="size-6" /></span>
                            <h3 class="mt-6 text-2xl font-bold text-ink-950">“When can you come?”</h3>
                            <p class="mt-3 leading-relaxed text-ink-600">Seven days a week, early starts and short-notice slots. Your crew gets a one-hour arrival window, not “sometime that morning”.</p>
                        </div>
                        <div class="grid shrink-0 grid-cols-7 gap-1.5 rounded-2xl bg-ink-50 p-4 text-center text-xs">
                            @foreach (['M','T','W','T','F','S','S'] as $d) <span class="font-semibold text-ink-400">{{ $d }}</span> @endforeach
                            @foreach (range(9, 22) as $day)
                                <span @class(['grid size-8 place-items-center rounded-lg font-semibold', 'bg-go-400 text-ink-950' => $day === 14, 'bg-white text-ink-800 ring-1 ring-ink-100' => !in_array($day, [14, 11, 18]), 'text-ink-300 line-through' => in_array($day, [11, 18])])>{{ $day }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card p-8" x-reveal="150">
                    <span class="grid size-12 place-items-center rounded-2xl bg-go-100 text-go-800"><x-icon name="shield-check" class="size-6" /></span>
                    <h3 class="mt-6 text-xl font-bold text-ink-950">“Will my things be safe?”</h3>
                    <p class="mt-2 leading-relaxed text-ink-600">Blanket-wrapped furniture, floor protection and full goods-in-transit cover on every job.</p>
                </div>
                <div class="relative overflow-hidden rounded-3xl bg-go-400 p-8 text-ink-950" x-reveal="200">
                    <x-icon name="zap" class="absolute -right-6 -bottom-6 size-40 text-ink-950/10" />
                    <h3 class="text-xl font-bold">Fast replies, always.</h3>
                    <p class="mt-2 leading-relaxed text-ink-900/80">Every enquiry answered {{ $ft['response_time'] }}. The first quote you get is usually ours.</p>
                    <a href="{{ route('quote') }}" class="btn mt-6 bg-ink-950 text-white hover:bg-ink-800">Try us <x-icon name="arrow-right" class="size-4" /></a>
                </div>
            </div>
        </div>
    </section>

    {{-- AREAS --}}
    <section class="border-y border-ink-100 bg-ink-50/60 py-16">
        <div class="container-page flex flex-col items-start gap-8 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-md">
                <h2 class="text-3xl font-bold text-ink-950">Where we move</h2>
                <p class="mt-2 text-ink-600">Based in the South East, moving people right across the UK and into Europe.</p>
            </div>
            <ul class="flex max-w-2xl flex-wrap gap-2">
                @foreach ($ft['areas'] as $area)
                    <li class="chip bg-white py-2"><x-icon name="map-pin" class="size-4 text-go-700" /> {{ $area }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- TESTIMONIALS (placeholder content in config) --}}
    <section class="py-20 lg:py-28">
        <div class="container-page">
            <div class="mx-auto max-w-2xl text-center">
                <p class="eyebrow"><span class="h-px w-6 bg-go-600"></span> Reviews <span class="h-px w-6 bg-go-600"></span></p>
                <h2 class="mt-4 text-4xl font-bold text-ink-950 sm:text-5xl">Moved by FastTrack.</h2>
            </div>
            <div class="mt-12 grid gap-4 md:grid-cols-3">
                @foreach ($ft['testimonials'] as $t)
                    <figure class="card flex flex-col p-7" x-reveal="{{ $loop->index * 100 }}">
                        <div class="flex gap-0.5 text-go-500">@for ($s = 0; $s < 5; $s++) <x-icon name="star" class="size-4 fill-current" /> @endfor</div>
                        <blockquote class="mt-5 flex-1 text-[15px] leading-relaxed text-ink-700">“{{ $t['body'] }}”</blockquote>
                        <figcaption class="mt-6 flex items-center gap-3 border-t border-ink-100 pt-5">
                            <span class="grid size-10 place-items-center rounded-full bg-ink-950 text-sm font-bold text-go-400">{{ strtoupper(substr($t['name'], 0, 1)) }}</span>
                            <span>
                                <span class="block text-sm font-semibold text-ink-950">{{ $t['name'] }}</span>
                                <span class="block text-xs text-ink-500">{{ $t['area'] }} · {{ $t['service'] }}</span>
                            </span>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="pb-20 lg:pb-28">
        <div class="container-page grid gap-12 lg:grid-cols-[1fr_1.4fr]">
            <div>
                <p class="eyebrow"><span class="h-px w-6 bg-go-600"></span> FAQ</p>
                <h2 class="mt-4 text-4xl font-bold text-ink-950">Good questions.</h2>
                <p class="mt-4 text-ink-600">Can't see yours? Call {{ $ft['phone'] }} or message us on WhatsApp. A real person replies.</p>
                <a href="{{ route('contact') }}" class="btn-ghost mt-6">Ask a question</a>
            </div>
            @include('partials.faq', ['faqs' => $ft['faqs']])
        </div>
    </section>
</x-layouts.site>
