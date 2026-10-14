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
                <a href="#{{ $platform['key'] }}" class="card-dark flex items-center gap-3 !rounded-full py-2.5 pr-5 pl-2.5 text-sm text-white/85 transition hover:border-gold-400/50 hover:text-white">
                    <span class="grid size-8 place-items-center rounded-full bg-gradient-to-br from-gold-300 to-ember text-navy-950"><x-icon :name="$platformIcons[$platform['key']]" class="size-4" stroke="1.8" /></span>
                    {{ $platform['title'] }}
                </a>
            @endforeach
            <a href="#project-finance" class="card-dark flex items-center gap-3 !rounded-full px-5 py-2.5 text-sm text-white/85 transition hover:border-gold-400/50 hover:text-white">Project Finance</a>
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

    {{-- Capital Solutions --}}
    <section id="capital" class="on-dark grain relative isolate scroll-mt-20 overflow-hidden bg-navy-950 py-24 text-white sm:py-32">
        <div class="grid-lines absolute inset-0 -z-10"></div>
        <div class="absolute top-0 right-0 -z-10 size-[40rem] rounded-full bg-navy-600/35 blur-[140px]"></div>

        <div class="container-x grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
            <div>
                <x-section-heading eyebrow="Platform 02 — Capital Solutions" title="The right capital, in the right structure." :lead="config('acpl.platforms.1.summary').' Hover across the capital stack to explore each layer.'" dark />

                <div class="mt-10 min-h-36">
                    @foreach ($stack as $layer)
                        <div data-pick-panel="stack:{{ $loop->index }}" @if (! $loop->first) hidden @endif>
                            <p class="text-sm tracking-[0.2em] text-gold-400 uppercase">{{ $layer['risk'] }}</p>
                            <h3 class="mt-3 font-display text-3xl">{{ $layer['title'] }}</h3>
                            <p class="mt-3 max-w-md text-white/65">{{ $layer['text'] }}</p>
                        </div>
                    @endforeach
                </div>

                <p class="mt-8 flex items-start gap-3 border-t border-white/10 pt-8 text-white/60" data-reveal>
                    <x-icon name="sparkle" class="mt-1 size-4 text-gold-400" />
                    {{ config('acpl.alternative_capital') }}
                </p>
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
    </section>

    {{-- Project finance --}}
    <section id="project-finance" class="scroll-mt-20 bg-white py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-16 lg:grid-cols-2">
            <div>
                <x-section-heading eyebrow="Project finance & capital raising" :title="$projectFinance['headline']" :lead="$projectFinance['intro']" />
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

            <div class="mt-16 grid grid-cols-1 items-start gap-16 lg:grid-cols-[1.2fr_0.8fr]">
                {{-- Investment funnel --}}
                <div>
                    <p class="mb-6 text-sm font-semibold tracking-[0.2em] text-navy-800 uppercase" data-reveal>We focus on businesses and projects that demonstrate</p>
                    <div class="flex flex-col items-center gap-2">
                        @foreach ($investment['criteria'] as $criterion)
                            <div @class([
                                    'flex items-center justify-center rounded-xl px-4 py-4 text-center text-sm font-semibold text-white transition duration-500 hover:scale-[1.02] hover:bg-gold-500 hover:text-navy-950 sm:text-base',
                                    ['bg-navy-950', 'bg-navy-900', 'bg-navy-800', 'bg-navy-700', 'bg-navy-600', 'bg-navy-500'][$loop->index] ?? 'bg-navy-500',
                                ])
                                style="width: {{ 100 - $loop->index * 9 }}%; --reveal-delay: {{ $loop->index * 90 }}ms"
                                data-reveal>
                                {{ $criterion }}
                            </div>
                        @endforeach
                        <div class="mt-2 flex items-center gap-3 rounded-full bg-gradient-to-r from-gold-400 to-ember px-6 py-3 font-display text-navy-950" data-reveal>
                            <x-icon name="sparkle" class="size-4" /> Long-term value
                        </div>
                    </div>
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

    <x-cta-band title="Have a mandate in mind?" lead="Tell us about your business, project or investment objective and we will show you how our platforms can work together for you." />
</x-layouts.app>
