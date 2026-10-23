<x-layouts.app title="What We Do" description="Advisory, capital solutions and investment management — three integrated platforms helping businesses, investors and institutions unlock growth.">
    @php
        $advisory = config('acpl.advisory');
        $stack = config('acpl.capital_stack');
        $projectFinance = config('acpl.project_finance');
        $investment = config('acpl.investment');
        $platformIcons = ['advisory' => 'compass', 'capital' => 'coins', 'investments' => 'chart'];
    @endphp

    <x-page-hero index="02" eyebrow="What we do" title="Three integrated platforms for <span class='text-gold-gradient'>growth.</span>" lead="We identify opportunities, structure solutions, mobilize capital and support execution — creating sustainable value for capital providers and capital users alike.">
        <div class="mt-12 flex flex-wrap gap-3" data-reveal style="--reveal-delay: 300ms">
            @foreach (config('acpl.platforms') as $platform)
                <a href="#{{ $platform['key'] }}" class="flex items-center gap-3 rounded-full border border-navy-900/12 bg-white py-2.5 pr-5 pl-2.5 text-sm font-medium text-navy-900 shadow-sm transition hover:border-gold-500">
                    <span class="grid size-8 place-items-center rounded-full bg-navy-900 text-gold-300"><x-icon :name="$platformIcons[$platform['key']]" class="size-4" stroke="1.8" /></span>
                    {{ $platform['title'] }}
                </a>
            @endforeach
        </div>
    </x-page-hero>

    {{-- Advisory --}}
    <section id="advisory" class="scroll-mt-20 bg-ivory py-24 sm:py-32">
        <div class="container-x">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:items-end">
                <x-section-heading eyebrow="Platform 01 — Advisory" :title="$advisory['headline']" />
                <p class="max-w-lg text-lg leading-relaxed text-mist lg:justify-self-end" data-reveal>{{ $advisory['intro'] }} {{ config('acpl.platforms.0.summary') }}</p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-6 lg:grid-cols-3">
                @foreach ($advisory['groups'] as $group)
                    <article class="card-light group flex flex-col p-9 transition duration-500 hover:-translate-y-1.5" data-reveal style="--reveal-delay: {{ $loop->index * 100 }}ms">
                        <div class="flex items-center justify-between">
                            <span class="grid size-12 place-items-center rounded-2xl bg-navy-900 text-gold-300 transition duration-500 group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950">
                                <x-icon :name="['coins', 'layers', 'shield'][$loop->index]" class="size-6" />
                            </span>
                            <span class="font-display text-4xl text-navy-900/10">0{{ $loop->iteration }}</span>
                        </div>
                        <h3 class="mt-8 font-display text-2xl text-navy-900">{{ $group['title'] }}</h3>
                        <ul class="mt-6 flex-1 divide-y divide-navy-900/8">
                            @foreach ($group['items'] as $item)
                                <li class="flex items-center gap-3 py-3 text-navy-800">
                                    <x-icon name="check" class="size-4 text-gold-600" stroke="2" />
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- E-invoice compliance advisory --}}
    <section id="einvoice" class="scroll-mt-20 bg-ivory pb-24 sm:pb-32">
        <div class="container-x">
            <div class="grid grid-cols-1 items-center gap-10 rounded-[2rem] border border-gold-500/30 bg-white p-8 sm:p-12 lg:grid-cols-[auto_1fr_auto]" data-reveal>
                <span class="grid size-16 place-items-center rounded-2xl bg-navy-900 text-gold-300"><x-icon name="document" class="size-8" /></span>
                <div>
                    <p class="text-xs font-semibold tracking-[0.22em] text-gold-600 uppercase">Platform 01 — Advisory · Compliance service</p>
                    <h3 class="mt-2 font-display text-3xl text-navy-900">{{ config('acpl.einvoice.title') }}</h3>
                    <p class="mt-3 max-w-2xl leading-relaxed text-mist">{{ config('acpl.einvoice.summary') }}</p>
                    <ul class="mt-5 flex flex-wrap gap-2">
                        @foreach (config('acpl.einvoice.points') as $point)
                            <li class="rounded-full bg-sand px-3.5 py-1.5 text-xs font-semibold text-navy-800">{{ $point }}</li>
                        @endforeach
                    </ul>
                </div>
                <a href="{{ route('contact', ['enquiry' => 'einvoice']) }}#enquire" class="btn-gold shrink-0">Get e-invoice advice <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
            </div>
        </div>
    </section>

    {{-- Capital Solutions --}}
    <section id="capital" class="on-dark grain relative isolate scroll-mt-20 overflow-hidden bg-navy-950 py-24 text-white sm:py-32">
        <div class="grid-lines absolute inset-0 -z-10"></div>
        <div class="absolute top-0 right-0 -z-10 size-[40rem] rounded-full bg-navy-600/35 blur-[140px]"></div>

        <div class="container-x grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
            <div>
                <x-section-heading eyebrow="Platform 02 — Capital Solutions" title="The right capital, in the right structure." :lead="config('acpl.platforms.1.summary').' Select a layer of the capital stack to see how it works and when it fits.'" dark />

                <div class="mt-10 min-h-56">
                    @foreach ($stack as $layer)
                        <div data-pick-panel="stack:{{ $loop->index }}" @if (! $loop->first) hidden @endif>
                            <p class="text-sm tracking-[0.2em] text-gold-400 uppercase">{{ $layer['risk'] }}</p>
                            <h3 class="mt-3 font-display text-3xl">{{ $layer['title'] }}</h3>
                            <p class="mt-3 max-w-md leading-relaxed text-white/70">{{ $layer['text'] }}</p>
                            <p class="mt-5 inline-flex items-center gap-2 rounded-full bg-white/[0.06] px-4 py-2 text-sm text-white/85"><x-icon name="target" class="size-4 text-gold-400" /> Best for: {{ $layer['suits'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Capital pyramid --}}
            <div class="relative" data-reveal="zoom">
                <div class="flex flex-col items-center gap-3">
                    @foreach ($stack as $layer)
                        <button type="button" data-pick="stack:{{ $loop->index }}" data-pick-hover
                            @class(['stack-layer group relative flex items-center justify-between rounded-2xl border border-white/10 px-6 py-6 text-left [&.is-active]:border-gold-400/60 [&.is-active]:bg-gradient-to-r [&.is-active]:from-gold-400 [&.is-active]:to-ember [&.is-active]:text-navy-950 sm:px-8', 'is-active' => $loop->first, 'bg-white/[0.04]'])
                            style="width: {{ 55 + $loop->index * 15 }}%">
                            <span class="font-display text-lg sm:text-xl">{{ $layer['title'] }}</span>
                            <span class="hidden text-xs tracking-wider uppercase opacity-60 sm:inline">0{{ $loop->iteration }}</span>
                        </button>
                    @endforeach
                </div>
                <div class="mt-8 flex items-center justify-between text-xs tracking-[0.2em] text-white/45 uppercase">
                    <span>↑ Higher risk / return</span>
                    <span>Lower cost of capital ↓</span>
                </div>
            </div>
        </div>

        {{-- Alternative capital: completes the stack when conventional layers do not fit --}}
        @php
            $alternative = config('acpl.alternative_capital');
        @endphp
        <div class="container-x mt-20">
            <div class="grid grid-cols-1 gap-8 rounded-[2rem] border border-gold-400/30 bg-gradient-to-br from-white/[0.07] to-white/[0.02] p-8 sm:p-12 lg:grid-cols-[0.9fr_1.1fr] lg:items-center" data-reveal>
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full bg-gold-400/15 px-3 py-1 text-xs font-semibold tracking-wider text-gold-300 uppercase"><x-icon name="sparkle" class="size-3.5" /> Beyond the conventional stack</span>
                    <h3 class="mt-5 font-display text-3xl sm:text-4xl">{{ $alternative['title'] }}</h3>
                    <p class="mt-4 max-w-lg leading-relaxed text-white/70">{{ $alternative['text'] }}</p>
                </div>
                <ul class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    @foreach ($alternative['items'] as $item)
                        <li class="flex items-center gap-3 rounded-2xl border border-white/10 bg-navy-900/60 px-5 py-4 text-white/85"><x-icon name="check" class="size-4 shrink-0 text-gold-400" stroke="2" /> {{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- Project finance --}}
    <section id="project-finance" class="scroll-mt-20 bg-white py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-16 lg:grid-cols-2">
            <div>
                <x-section-heading eyebrow="Platform 02 — Project finance & capital raising" :title="$projectFinance['headline']" :lead="$projectFinance['intro']" />
                <ol class="mt-12 grid grid-cols-1 gap-3 sm:grid-cols-2">
                    @foreach ($projectFinance['services'] as $service)
                        <li class="flex items-center gap-4 rounded-2xl border border-navy-900/8 bg-ivory px-5 py-4 transition hover:border-gold-500/40" data-reveal style="--reveal-delay: {{ $loop->index * 60 }}ms">
                            <span class="font-display text-gold-600">0{{ $loop->iteration }}</span>
                            <span class="font-medium text-navy-900">{{ $service }}</span>
                        </li>
                    @endforeach
                </ol>
            </div>

            {{-- Capital sources orbit --}}
            <div class="relative mx-auto aspect-square w-full max-w-lg" data-reveal="zoom">
                <div class="absolute inset-[6%] rounded-full border border-dashed border-gold-500/30 motion-safe:animate-[spin_90s_linear_infinite]"></div>
                <div class="absolute inset-[24%] rounded-full border border-navy-900/10"></div>
                <div class="absolute inset-[34%] grid place-items-center rounded-full bg-navy-900 text-center shadow-[0_30px_60px_-20px_rgba(7,24,52,0.6)]">
                    <div>
                        <p class="font-display text-xl text-white sm:text-2xl">Capital</p>
                        <p class="text-[0.6rem] tracking-[0.25em] text-gold-400 uppercase sm:text-xs">Sources</p>
                    </div>
                </div>
                @foreach ($projectFinance['sources'] as $source)
                    @php
                        $angle = deg2rad(-90 + $loop->index * (360 / count($projectFinance['sources'])));
                        $left = 50 + 41 * cos($angle);
                        $top = 50 + 41 * sin($angle);
                    @endphp
                    <span class="absolute max-w-32 -translate-x-1/2 -translate-y-1/2 rounded-2xl border border-navy-900/10 bg-white px-3 py-2 text-center text-[0.7rem] leading-tight font-semibold text-navy-900 shadow-lg sm:max-w-40 sm:text-xs" style="left: {{ round($left, 2) }}%; top: {{ round($top, 2) }}%">{{ $source }}</span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Investments --}}
    <section id="investments" class="scroll-mt-20 bg-sand py-24 sm:py-32">
        <div class="container-x">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:items-end">
                <x-section-heading eyebrow="Platform 03 — Investment management" :title="$investment['headline']" />
                <p class="max-w-lg text-lg leading-relaxed text-mist lg:justify-self-end" data-reveal>{{ $investment['philosophy'] }}</p>
            </div>

            <div class="mt-16 grid grid-cols-1 items-start gap-10 lg:grid-cols-[1.25fr_0.75fr]">
                {{-- Investment criteria --}}
                <div>
                    <p class="mb-6 text-sm font-semibold tracking-[0.2em] text-navy-800 uppercase" data-reveal>What we look for</p>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach ($investment['criteria'] as $criterion)
                            <div class="card-light group flex gap-5 p-6 transition duration-500 hover:-translate-y-1" data-reveal style="--reveal-delay: {{ $loop->index * 90 }}ms">
                                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-navy-900 text-gold-300 transition duration-500 group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950"><x-icon :name="$criterion['icon']" class="size-6" /></span>
                                <div>
                                    <h3 class="font-display text-xl text-navy-900">{{ $criterion['title'] }}</h3>
                                    <p class="mt-1 text-sm leading-relaxed text-mist">{{ $criterion['text'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-6 flex items-center gap-3 font-display text-lg text-navy-900" data-reveal><x-icon name="sparkle" class="size-4 text-gold-600" /> The result: long-term value for investors and investees alike.</p>
                </div>

                <div class="card-light p-9" data-reveal="right">
                    <h3 class="font-display text-2xl text-navy-900">Investment strategies</h3>
                    <ul class="mt-6 space-y-3">
                        @foreach ($investment['strategies'] as $strategy)
                            <li class="group flex items-center justify-between rounded-2xl bg-ivory px-5 py-4 transition hover:bg-navy-900">
                                <span class="font-medium text-navy-900 transition group-hover:text-white">{{ $strategy }}</span>
                                <x-icon name="arrow-up-right" class="size-4 text-gold-600 transition group-hover:text-gold-300" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <x-cta-band page="services" />
</x-layouts.app>
