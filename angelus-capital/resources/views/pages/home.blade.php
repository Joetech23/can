<x-layouts.app>
    @php
        $company = config('acpl.company');
        $headline = ['Creating', 'sustainable', 'value', 'through', 'strategic', 'capital', 'solutions.'];
        $highlighted = ['sustainable', 'value'];
        $platformIcons = ['advisory' => 'compass', 'capital' => 'coins', 'investments' => 'chart'];
    @endphp

    {{-- Hero --}}
    <section class="relative isolate flex min-h-[100svh] items-center overflow-hidden bg-white pt-32 pb-28" data-tilt-area>
        <div class="brand-lines absolute inset-0 -z-10"></div>
        <div class="absolute top-[-20%] right-[-10%] -z-10 size-[44rem] rounded-full bg-gold-200/45 blur-[140px]"></div>
        <canvas data-ribbons="12" data-tone="light" class="absolute inset-0 -z-10 h-full w-full"></canvas>

        <div class="container-x grid grid-cols-1 items-center gap-14 lg:grid-cols-[1fr_1fr]">
            <div>
                <span class="eyebrow !text-sm !tracking-[0.2em]" data-reveal>{{ $company['tagline'] }}</span>

                <h1 class="mt-7 max-w-xl font-display text-[2.1rem] leading-[1.15] text-navy-900 sm:text-[2.6rem] xl:text-[2.85rem]">
                    @foreach ($headline as $word)
                        <span class="split-word"><span style="--i: {{ $loop->index }}" @class(['text-gold-gradient' => in_array($word, $highlighted)])>{{ $word }}</span></span>
                    @endforeach
                </h1>

                <span class="mt-8 flex w-56 items-center gap-2" aria-hidden="true" data-reveal style="--reveal-delay: 500ms">
                    <span class="h-px flex-1 bg-gold-500/70"></span><span class="size-1.5 rotate-45 bg-gold-500"></span><span class="h-px flex-1 bg-gold-500/70"></span>
                </span>

                <p class="mt-8 max-w-xl text-lg leading-relaxed text-mist" data-reveal style="--reveal-delay: 600ms">{{ $company['summary'] }}</p>

                <div class="mt-10 flex flex-wrap gap-4" data-reveal style="--reveal-delay: 750ms">
                    <a href="{{ route('services') }}" class="btn-gold">Explore what we do <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
                    <a href="{{ route('contact') }}" class="btn-ghost">Talk to our team</a>
                </div>
            </div>

            {{-- The three integrated platforms orbiting the mark --}}
            <div class="relative mx-auto aspect-square w-full max-w-[36rem] lg:max-w-[40rem]" data-reveal="zoom" style="--reveal-delay: 300ms">
                <div class="absolute inset-0 rounded-full border border-navy-900/10"></div>
                <div class="absolute inset-[9%] rounded-full border border-dashed border-gold-500/40 motion-safe:animate-[spin_80s_linear_infinite]"></div>
                <div class="absolute inset-[22%] rounded-full bg-gold-300/25 blur-3xl"></div>

                <div class="absolute inset-[20%] grid place-items-center" data-tilt="16">
                    <img src="{{ asset('images/acpl-logo.webp') }}" alt="The Angelus Capital Partners mark" width="600" height="566" class="w-full animate-float drop-shadow-[0_30px_50px_rgba(239,125,16,0.3)]" fetchpriority="high">
                </div>

                @foreach (config('acpl.platforms') as $platform)
                    @php($positions = ['top-[2%] left-1/2 -translate-x-1/2', 'right-0 bottom-[24%] sm:right-[-4%] sm:bottom-[16%]', 'bottom-[2%] left-0 sm:left-[-4%] sm:bottom-[16%]'])
                    <a href="{{ route('services') }}#{{ $platform['key'] }}" class="absolute {{ $positions[$loop->index] }} flex items-center gap-3 rounded-full border border-navy-900/10 bg-white py-2 pr-5 pl-2 font-display text-base whitespace-nowrap sm:py-3 sm:pr-6 sm:pl-3 text-navy-900 shadow-[0_20px_40px_-20px_rgba(0,20,64,0.45)] transition hover:border-gold-500 sm:text-lg">
                        <span class="grid size-9 place-items-center rounded-full bg-navy-900 text-gold-300 sm:size-10">
                            <x-icon :name="$platformIcons[$platform['key']]" class="size-5" stroke="1.8" />
                        </span>
                        <span><span class="block text-[0.6rem] font-sans font-semibold tracking-[0.2em] text-gold-600 uppercase">Platform 0{{ $loop->iteration }}</span>{{ $platform['title'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <x-brand-wave class="absolute inset-x-0 bottom-0 h-12 sm:h-16" />
    </section>

    {{-- Ticker: announcements or partner logos (config: acpl.ticker) --}}
    <div class="flex items-stretch overflow-hidden bg-navy-900" aria-label="{{ config('acpl.ticker.label') }}">
        <p class="relative z-10 hidden shrink-0 items-center bg-gradient-to-r from-gold-400 to-ember px-6 text-xs font-bold tracking-[0.2em] text-navy-950 uppercase sm:flex">{{ config('acpl.ticker.label') }}</p>
        <div class="flex-1 overflow-hidden py-5">
            <div class="flex w-max animate-marquee gap-12 whitespace-nowrap hover:[animation-play-state:paused]" style="animation-duration: 60s">
                @foreach ([0, 1] as $copy)
                    @foreach (config('acpl.ticker.items') as $item)
                        <span class="flex items-center gap-12" @if ($copy) aria-hidden="true" @endif>
                            @if (filled($item['url'] ?? null))
                                <a href="{{ url($item['url']) }}" class="flex items-center text-white/80 transition hover:text-gold-300" @if ($copy) tabindex="-1" @endif>
                            @else
                                <span class="flex items-center text-white/80">
                            @endif
                                @if (filled($item['logo'] ?? null))
                                    <img src="{{ asset($item['logo']) }}" alt="{{ $item['text'] ?? '' }}" loading="lazy" class="h-8 w-auto opacity-80 brightness-0 invert">
                                @else
                                    <span class="text-[0.95rem]">{{ $item['text'] }}</span>
                                @endif
                            @if (filled($item['url'] ?? null))
                                </a>
                            @else
                                </span>
                            @endif
                            <x-icon name="sparkle" class="size-3.5 text-gold-400" />
                        </span>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

    {{-- At a glance --}}
    <section id="glance" class="bg-ivory py-24 sm:py-32">
        <div class="container-x">
            <div class="grid grid-cols-1 gap-16 lg:grid-cols-[0.9fr_1.1fr] lg:items-end">
                <x-section-heading eyebrow="ACPL at a glance" title="Connecting capital with <em class='font-serif text-gold-600'>opportunity</em>." />
                <p class="max-w-xl text-lg leading-relaxed text-mist lg:justify-self-end" data-reveal>{{ config('acpl.about.intro') }}</p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-px overflow-hidden rounded-3xl border border-navy-900/8 bg-navy-900/8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (config('acpl.metrics') as $metric)
                    <div class="group relative bg-white p-8 transition duration-500 hover:bg-navy-900 sm:p-10" data-reveal style="--reveal-delay: {{ $loop->index * 90 }}ms">
                        <p class="font-display text-5xl text-navy-900 transition duration-500 group-hover:text-gold-300 xl:text-6xl">
                            <span data-count="{{ $metric['value'] }}" data-prefix="{{ $metric['prefix'] }}" data-suffix="{{ $metric['suffix'] }}">{{ $metric['prefix'] }}{{ $metric['value'] }}{{ $metric['suffix'] }}</span>
                        </p>
                        <p class="mt-5 font-semibold text-navy-900 transition duration-500 group-hover:text-white">{{ $metric['label'] }}</p>
                        <p class="mt-2 text-sm leading-relaxed text-mist transition duration-500 group-hover:text-white/60">{{ $metric['note'] }}</p>
                        <span class="absolute top-8 right-8 h-px w-8 bg-gold-500 transition-all duration-500 group-hover:w-14"></span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Who we are --}}
    <section class="bg-white py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-16 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="lg:sticky lg:top-32">
                    <x-section-heading eyebrow="Who we are" title="An alternative asset partner across the entire capital lifecycle." lead="We provide advisory, capital and investment solutions — from business strategy and project development to capital raising, transaction execution and investment management." />
                    <a href="{{ route('about') }}" class="link-arrow mt-10" data-reveal>Discover our story <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
                    <img src="{{ asset('images/skyline.webp') }}" alt="Glass office towers reflecting the morning light" width="653" height="980" loading="lazy" class="mt-10 hidden w-full max-w-sm lg:block" data-reveal="fade">
                </div>
            </div>

            <div class="flex flex-col gap-6 lg:col-span-7">
                @foreach (config('acpl.about.pillars') as $pillar)
                    <article class="card-light group flex gap-8 p-8 transition duration-500 hover:-translate-y-1 sm:p-10" data-reveal style="--reveal-delay: {{ $loop->index * 100 }}ms">
                        <span class="font-display text-5xl text-gold-500/40 transition group-hover:text-gold-500">0{{ $loop->iteration }}</span>
                        <div>
                            <h3 class="font-display text-2xl text-navy-900">{{ $pillar['title'] }}</h3>
                            <p class="mt-3 leading-relaxed text-mist">{{ $pillar['text'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Three integrated platforms --}}
    <section class="on-dark grain relative isolate overflow-hidden bg-navy-950 py-24 text-white sm:py-32">
        <div class="grid-lines absolute inset-0 -z-10"></div>
        <div class="absolute top-1/3 left-1/2 -z-10 size-[44rem] -translate-x-1/2 rounded-full bg-navy-600/35 blur-[140px]"></div>

        <div class="container-x">
            <x-section-heading eyebrow="What we do" title="Three integrated platforms. <span class='text-gold-gradient'>One partner.</span>" lead="Advisory, capital solutions and investments work together, so every engagement benefits from the full strength of the firm." align="center" dark />

            <div class="mt-20 grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
                {{-- Ecosystem diagram --}}
                <div class="relative mx-auto w-full max-w-lg" data-reveal="zoom">
                    <svg viewBox="0 0 400 380" class="w-full" role="img" aria-label="Advisory, Capital Solutions and Investments overlapping around ACPL">
                        <defs>
                            <radialGradient id="eco-a" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="#e8b654" stop-opacity="0.32" /><stop offset="100%" stop-color="#e8b654" stop-opacity="0.04" /></radialGradient>
                            <radialGradient id="eco-b" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="#ef7d10" stop-opacity="0.3" /><stop offset="100%" stop-color="#ef7d10" stop-opacity="0.04" /></radialGradient>
                            <radialGradient id="eco-c" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="#2f5893" stop-opacity="0.65" /><stop offset="100%" stop-color="#2f5893" stop-opacity="0.08" /></radialGradient>
                        </defs>
                        <g class="transition-opacity duration-500">
                            <circle cx="200" cy="130" r="112" fill="url(#eco-a)" stroke="#e8b654" stroke-opacity="0.55" />
                            <circle cx="135" cy="245" r="112" fill="url(#eco-c)" stroke="#f2d18a" stroke-opacity="0.35" />
                            <circle cx="265" cy="245" r="112" fill="url(#eco-b)" stroke="#ef7d10" stroke-opacity="0.5" />
                        </g>
                        <text x="200" y="88" text-anchor="middle" fill="#fff" font-size="17" font-family="var(--font-marcellus)">Advisory</text>
                        <text x="95" y="285" text-anchor="middle" fill="#fff" font-size="17" font-family="var(--font-marcellus)">Capital</text>
                        <text x="95" y="305" text-anchor="middle" fill="#fff" font-size="17" font-family="var(--font-marcellus)">Solutions</text>
                        <text x="305" y="295" text-anchor="middle" fill="#fff" font-size="17" font-family="var(--font-marcellus)">Investments</text>
                        <circle cx="200" cy="208" r="38" fill="#001440" stroke="#e8b654" stroke-width="1.5" />
                        <text x="200" y="214" text-anchor="middle" fill="#f2d18a" font-size="17" letter-spacing="2" font-family="var(--font-marcellus)">ACPL</text>
                    </svg>
                </div>

                <div class="flex flex-col gap-5">
                    @foreach (config('acpl.platforms') as $platform)
                        <a href="{{ route('services') }}#{{ $platform['key'] }}" class="card-dark group block p-7 transition duration-500 hover:border-gold-400/40 hover:bg-white/[0.06] sm:p-8" data-reveal="right" style="--reveal-delay: {{ $loop->index * 110 }}ms">
                            <div class="flex items-start gap-5">
                                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-gold-300 to-ember text-navy-950">
                                    <x-icon :name="$platformIcons[$platform['key']]" class="size-6" />
                                </span>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between gap-4">
                                        <h3 class="font-display text-2xl">{{ $platform['title'] }}</h3>
                                        <x-icon name="arrow-up-right" class="size-5 text-gold-400 transition duration-500 group-hover:translate-x-1 group-hover:-translate-y-1" />
                                    </div>
                                    <p class="mt-2 text-white/60">{{ $platform['summary'] }}</p>
                                    <div class="mt-5 flex flex-wrap gap-2">
                                        @foreach ($platform['items'] as $item)
                                            <span class="rounded-full border border-white/10 px-3 py-1 text-xs text-white/70">{{ $item }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Value proposition --}}
    <section class="relative overflow-hidden bg-sand py-24 sm:py-32">
        <div class="container-x">
            <span class="eyebrow" data-reveal>Our value proposition</span>
            <p class="mt-8 max-w-5xl font-display text-3xl leading-snug text-navy-900 sm:text-4xl lg:text-[2.6rem]" data-reveal style="--reveal-delay: 80ms">{{ config('acpl.value_proposition.statement') }}</p>

            <div class="mt-16 grid grid-cols-1 gap-6 md:grid-cols-3">
                @foreach (config('acpl.value_proposition.promises') as $promise)
                    <article class="card-light group relative overflow-hidden p-8 sm:p-10" data-reveal style="--reveal-delay: {{ $loop->index * 110 }}ms">
                        <span class="absolute top-0 left-8 h-1 w-16 rounded-b-full bg-gradient-to-r from-gold-400 to-ember"></span>
                        <div class="flex items-center justify-between">
                            <span class="grid size-12 place-items-center rounded-2xl bg-navy-900 text-gold-300 transition duration-500 group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950"><x-icon :name="$promise['icon']" class="size-6" /></span>
                            <span class="text-xs font-semibold tracking-[0.2em] text-gold-600 uppercase">{{ $promise['platform'] }}</span>
                        </div>
                        <h3 class="mt-8 font-display text-2xl text-navy-900">{{ $promise['title'] }}</h3>
                        <p class="mt-3 leading-relaxed text-mist">{{ $promise['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How we create value --}}
    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x">
            <div class="flex flex-col justify-between gap-8 lg:flex-row lg:items-end">
                <x-section-heading eyebrow="How we create value" title="From concept to completion." />
                <p class="max-w-md leading-relaxed text-mist" data-reveal>{{ config('acpl.value_proposition.outcome') }}</p>
            </div>

            <ol class="mt-16 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-6 lg:gap-0">
                @foreach (config('acpl.process') as $step)
                    <li class="group relative" data-reveal style="--reveal-delay: {{ $loop->index * 90 }}ms">
                        <div @class([
                            'flex h-full flex-col justify-between gap-10 p-7 transition duration-500 lg:min-h-72 lg:pr-9 lg:pl-10',
                            'rounded-3xl lg:rounded-none',
                            $loop->first ? 'lg:chevron-first lg:pl-7' : 'lg:chevron',
                            $loop->even ? 'bg-navy-900 text-white' : 'bg-navy-800 text-white',
                            'group-hover:bg-gradient-to-br group-hover:from-gold-400 group-hover:to-ember group-hover:text-navy-950',
                        ])>
                            <span class="font-display text-4xl text-gold-400 transition group-hover:text-navy-950">0{{ $loop->iteration }}</span>
                            <div>
                                <h3 class="font-display text-2xl">{{ $step['title'] }}</h3>
                                <p class="mt-3 text-sm leading-relaxed opacity-70">{{ $step['text'] }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Sectors --}}
    <section class="bg-white py-24 sm:py-32">
        <div class="container-x">
            <div class="flex flex-col justify-between gap-8 lg:flex-row lg:items-end">
                <x-section-heading eyebrow="Sectors of focus" title="Deep knowledge across Africa’s key growth sectors." />
                <a href="{{ route('sectors') }}" class="link-arrow shrink-0" data-reveal>All sectors <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (config('acpl.sectors') as $sector)
                    <article class="group relative overflow-hidden rounded-3xl border border-navy-900/8 bg-ivory p-8 transition duration-500 hover:-translate-y-1.5 hover:border-transparent hover:bg-navy-900 hover:shadow-[0_30px_60px_-30px_rgba(7,24,52,0.6)]" data-reveal style="--reveal-delay: {{ ($loop->index % 3) * 80 }}ms">
                        <span class="grid size-14 place-items-center rounded-2xl bg-white text-gold-600 shadow-sm transition duration-500 group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950">
                            <x-icon :name="$sector['icon']" class="size-7" />
                        </span>
                        <h3 class="mt-8 font-display text-xl text-navy-900 transition group-hover:text-white">{{ $sector['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-mist transition group-hover:text-white/65">{{ $sector['text'] }}</p>
                        <span class="pointer-events-none absolute -right-4 -bottom-6 font-display text-8xl text-navy-900/[0.04] transition group-hover:text-white/[0.06]">0{{ $loop->iteration }}</span>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Transaction credentials preview --}}
    <section class="on-dark relative overflow-hidden bg-navy-900 py-24 text-white sm:py-32">
        <div class="container-x">
            <div class="flex flex-col justify-between gap-8 lg:flex-row lg:items-end">
                <x-section-heading eyebrow="Transaction experience" title="Selected credentials across sectors and geographies." :lead="config('acpl.transactions.intro')" dark />
                <a href="{{ route('sectors') }}#transactions" class="btn-outline shrink-0" data-reveal>View all credentials <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
            </div>
        </div>

        <div class="relative mt-16 overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_8%,black_92%,transparent)]">
            <div class="flex w-max animate-marquee gap-5 hover:[animation-play-state:paused]" style="animation-duration: 70s">
                @foreach ([0, 1] as $copy)
                    @foreach (config('acpl.transactions.groups') as $group)
                        @foreach ($group['deals'] as $deal)
                            <div class="flex h-56 w-72 shrink-0 flex-col justify-between rounded-3xl border border-gold-400/20 bg-gradient-to-b from-white/[0.06] to-transparent p-7" @if ($copy) aria-hidden="true" @endif>
                                <div class="flex items-start justify-between gap-6">
                                    <x-icon :name="$group['icon']" class="size-6 text-gold-400" />
                                    <span class="max-w-36 text-right text-[0.62rem] leading-relaxed tracking-[0.18em] text-white/40 uppercase">{{ $group['sector'] }}</span>
                                </div>
                                <div>
                                    <p class="font-display text-2xl leading-tight">{{ $deal['name'] }}</p>
                                    <p class="mt-2 text-sm text-gold-300/80">{{ $deal['type'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    {{-- Chairman --}}
    <section class="bg-sand py-24 sm:py-32">
        <div class="container-x">
            <figure class="mx-auto max-w-5xl text-center" data-reveal>
                <x-icon name="quote" class="mx-auto size-12 text-gold-500" stroke="1" />
                <blockquote class="mt-8 font-serif text-3xl leading-snug text-navy-900 italic sm:text-5xl">
                    “{{ config('acpl.chairman.pull_quote') }}”
                </blockquote>
                <figcaption class="mt-10 flex items-center justify-center gap-4">
                    <img src="{{ asset(config('acpl.chairman.photo')) }}" alt="{{ config('acpl.chairman.name') }}" width="56" height="56" loading="lazy" class="size-14 rounded-full object-cover object-top ring-2 ring-gold-400 ring-offset-2 ring-offset-sand">
                    <span class="text-left">
                        <span class="block font-semibold text-navy-900">{{ config('acpl.chairman.name') }}</span>
                        <span class="block text-sm text-mist">{{ config('acpl.chairman.title') }}</span>
                    </span>
                </figcaption>
                <a href="{{ route('about') }}#chairman" class="link-arrow mt-10">Read the Chairman’s message <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
            </figure>
        </div>
    </section>

    {{-- Leadership --}}
    <section class="bg-white py-24 sm:py-32">
        <div class="container-x">
            <div class="flex flex-col justify-between gap-8 lg:flex-row lg:items-end">
                <x-section-heading eyebrow="Leadership" title="Led by people who have built institutions." lead="Decades of combined experience across venture capital, private equity, banking, audit, pensions and corporate governance." />
                <a href="{{ route('leadership') }}" class="link-arrow shrink-0" data-reveal>Meet the team <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-3">
                @foreach (config('acpl.leadership') as $leader)
                    <a href="{{ route('leadership.show', $leader['slug']) }}" class="group block" data-reveal style="--reveal-delay: {{ $loop->index * 120 }}ms">
                        <x-portrait :leader="$leader" class="mx-auto w-full max-w-60" />
                        <div class="mt-6 text-center">
                            <p class="font-display text-2xl text-navy-900 transition group-hover:text-gold-600">{{ $leader['name'] }}</p>
                            <p class="mt-1 text-xs font-semibold tracking-[0.22em] text-gold-600 uppercase">{{ $leader['role'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why partner --}}
    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-16 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <x-section-heading eyebrow="Why partner with ACPL" title="Six reasons clients choose us." lead="Experience, networks and the discipline to move transactions from concept to completion." />
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:col-span-8 lg:grid-cols-3">
                @foreach (config('acpl.differentiators') as $item)
                    @php($icons = ['users', 'network', 'target', 'layers', 'scale', 'handshake'])
                    <div class="group" data-reveal style="--reveal-delay: {{ ($loop->index % 3) * 90 }}ms">
                        <div class="hex grid size-20 place-items-center bg-navy-900 text-gold-300 transition duration-500 group-hover:rotate-[30deg] group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950">
                            <x-icon :name="$icons[$loop->index]" class="size-8 transition duration-500 group-hover:-rotate-[30deg]" />
                        </div>
                        <h3 class="mt-6 font-display text-xl text-navy-900">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-mist">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Looking ahead --}}
    <section class="on-dark grain relative isolate overflow-hidden bg-navy-950 py-24 text-white sm:py-32">
        <div class="absolute inset-y-0 right-0 -z-10 w-1/2 bg-gradient-to-l from-navy-700/50 to-transparent"></div>
        <div class="container-x grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
            <div>
                <x-section-heading eyebrow="Looking ahead" :title="config('acpl.outlook.headline')" dark />
                <div class="mt-8 space-y-5 text-lg leading-relaxed text-white/65">
                    @foreach (config('acpl.outlook.paragraphs') as $paragraph)
                        <p data-reveal style="--reveal-delay: {{ $loop->index * 90 }}ms">{{ $paragraph }}</p>
                    @endforeach
                </div>
                <p class="mt-10 font-serif text-3xl text-gold-300 italic" data-reveal>{{ config('acpl.outlook.closing') }}</p>
            </div>
            <ul class="flex flex-col gap-3">
                @foreach (config('acpl.outlook.drivers') as $driver)
                    <li class="card-dark flex items-center justify-between px-7 py-6 transition duration-500 hover:border-gold-400/40" data-reveal="right" style="--reveal-delay: {{ $loop->index * 90 }}ms">
                        <span class="font-display text-xl sm:text-2xl">{{ $driver }}</span>
                        <span class="text-sm text-gold-400">0{{ $loop->iteration }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-cta-band page="home" />
</x-layouts.app>
