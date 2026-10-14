<x-layouts.app title="About Us" description="{{ config('acpl.about.intro') }}">
    @php
        $chairman = config('acpl.chairman');
        $values = config('acpl.values');
        $valueIcons = ['shield', 'target', 'handshake', 'scale', 'users'];
        $segmentCount = count($values);
    @endphp

    <x-page-hero index="01" eyebrow="About Angelus Capital Partners" title="Building institutions. Enabling growth. <span class='text-gold-gradient'>Creating value.</span>" :lead="config('acpl.about.intro')" />

    {{-- Who we are --}}
    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-16 lg:grid-cols-2">
            <x-section-heading eyebrow="Who we are" title="Capital, insight and execution — under one roof." />
            <div class="space-y-6 text-lg leading-relaxed text-mist" data-reveal>
                <p>We provide advisory and investment solutions across the entire capital lifecycle—from business strategy and project development to capital raising, transaction execution and investment management.</p>
                <p>Our professionals bring together decades of experience spanning banking, private equity, venture capital, corporate finance, project finance, investment management, restructuring and business transformation.</p>
            </div>
        </div>

        <div class="container-x mt-20 grid grid-cols-1 gap-6 md:grid-cols-3">
            @foreach (config('acpl.about.pillars') as $pillar)
                <article class="card-light relative overflow-hidden p-10" data-reveal style="--reveal-delay: {{ $loop->index * 100 }}ms">
                    <span class="absolute top-0 left-10 h-1 w-16 rounded-b-full bg-gradient-to-r from-gold-400 to-ember"></span>
                    <span class="font-display text-6xl text-navy-900/10">0{{ $loop->iteration }}</span>
                    <h3 class="mt-6 font-display text-2xl text-navy-900">{{ $pillar['title'] }}</h3>
                    <p class="mt-3 leading-relaxed text-mist">{{ $pillar['text'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Who we serve --}}
    <section class="on-dark relative overflow-hidden bg-navy-900 py-24 text-white sm:py-32">
        <div class="grid-lines absolute inset-0"></div>
        <div class="container-x relative">
            <x-section-heading eyebrow="We serve" title="Trusted by those who provide — and need — capital." align="center" dark />
            <ul class="mt-16 flex flex-wrap justify-center gap-4">
                @foreach (config('acpl.about.clients') as $client)
                    <li class="card-dark !rounded-full px-6 py-3.5 text-white/85 transition duration-500 hover:-translate-y-1 hover:border-gold-400/50 hover:text-gold-200" data-reveal="zoom" style="--reveal-delay: {{ $loop->index * 50 }}ms">
                        <span class="mr-2 text-gold-400">◆</span>{{ $client }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Chairman's message --}}
    <section id="chairman" class="scroll-mt-24 bg-white py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-16 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="lg:sticky lg:top-32" data-reveal="left">
                    <div class="on-dark grain relative isolate aspect-[4/5] overflow-hidden rounded-[2rem] bg-navy-950 p-10" data-tilt-area>
                        <div class="absolute -top-20 -right-20 -z-10 size-80 rounded-full bg-gold-500/25 blur-3xl"></div>
                        <div class="grid-lines absolute inset-0 -z-10"></div>
                        <img src="{{ asset('images/acpl-mark.webp') }}" alt="" width="317" height="288" data-tilt="12" class="absolute top-1/2 left-1/2 w-3/4 -translate-x-1/2 -translate-y-[60%] opacity-90 drop-shadow-[0_30px_60px_rgba(239,125,16,0.35)]">
                        <div class="absolute inset-x-10 bottom-10">
                            <p class="font-display text-3xl text-white">{{ $chairman['name'] }}</p>
                            <p class="mt-1 text-sm tracking-[0.2em] text-gold-400 uppercase">{{ $chairman['title'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <span class="eyebrow" data-reveal>Chairman’s message</span>
                <h2 class="mt-6 font-display text-4xl leading-tight text-navy-900 sm:text-5xl" data-reveal>{{ $chairman['headline'] }}</h2>
                <div class="mt-10 space-y-6 text-lg leading-relaxed text-mist">
                    @foreach ($chairman['message'] as $paragraph)
                        <p data-reveal @class(['first-letter:float-left first-letter:mt-1 first-letter:mr-2 first-letter:font-display first-letter:text-6xl first-letter:leading-[0.8] first-letter:text-gold-600' => $loop->first])>{{ $paragraph }}</p>
                    @endforeach
                </div>
                <div class="mt-12 border-t border-navy-900/10 pt-8" data-reveal>
                    <p class="font-serif text-3xl text-navy-900 italic">{{ $chairman['name'] }}</p>
                    <p class="mt-1 text-sm text-mist">{{ $chairman['title'] }}, {{ config('acpl.company.name') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Vision & mission --}}
    <section class="bg-sand py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-6 lg:grid-cols-2">
            @foreach (['Vision' => config('acpl.vision'), 'Mission' => config('acpl.mission')] as $label => $statement)
                <article @class([
                    'relative isolate overflow-hidden rounded-[2rem] p-10 sm:p-14',
                    'on-dark bg-navy-900 text-white' => $loop->first,
                    'bg-white text-navy-900' => $loop->last,
                ]) data-reveal style="--reveal-delay: {{ $loop->index * 120 }}ms">
                    <span class="absolute -right-6 -bottom-16 -z-10 font-display text-[11rem] leading-none {{ $loop->first ? 'text-white/[0.04]' : 'text-navy-900/[0.04]' }}">{{ $label }}</span>
                    <span class="eyebrow">Our {{ strtolower($label) }}</span>
                    <p class="mt-8 font-display text-3xl leading-snug sm:text-4xl">{{ $statement }}</p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Values wheel --}}
    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x">
            <x-section-heading eyebrow="Core values" title="The principles behind every mandate." lead="Select a value to explore what it means for the way we work." align="center" />

            <div class="mt-16 grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
                <div class="mx-auto w-full max-w-md" data-reveal="zoom">
                    <svg viewBox="0 0 400 400" class="w-full overflow-visible" role="tablist" aria-label="Core values">
                        @foreach ($values as $value)
                            @php
                                $start = deg2rad(-90 + $loop->index * (360 / $segmentCount) + 1.5);
                                $end = deg2rad(-90 + ($loop->index + 1) * (360 / $segmentCount) - 1.5);
                                $mid = ($start + $end) / 2;
                                [$outer, $inner] = [190, 92];
                                $path = sprintf(
                                    'M %.2f %.2f A %d %d 0 0 1 %.2f %.2f L %.2f %.2f A %d %d 0 0 0 %.2f %.2f Z',
                                    200 + $outer * cos($start), 200 + $outer * sin($start), $outer, $outer,
                                    200 + $outer * cos($end), 200 + $outer * sin($end),
                                    200 + $inner * cos($end), 200 + $inner * sin($end), $inner, $inner,
                                    200 + $inner * cos($start), 200 + $inner * sin($start),
                                );
                                $labelX = 200 + 141 * cos($mid);
                                $labelY = 200 + 141 * sin($mid);
                            @endphp
                            <g role="tab" tabindex="0" aria-label="{{ $value['title'] }}" data-pick="value:{{ $loop->index }}" data-pick-hover aria-selected="{{ $loop->first ? 'true' : 'false' }}" @class(['wheel-segment group outline-none', 'is-active' => $loop->first])>
                                <path d="{{ $path }}" class="fill-navy-800 transition-colors duration-500 group-hover:fill-gold-500 group-focus-visible:fill-gold-500 group-[.is-active]:fill-gold-500" />
                                <foreignObject x="{{ $labelX - 22 }}" y="{{ $labelY - 22 }}" width="44" height="44" class="pointer-events-none">
                                    <div class="grid size-11 place-items-center text-gold-300 group-[.is-active]:text-navy-950">
                                        <x-icon :name="$valueIcons[$loop->index]" class="size-6" />
                                    </div>
                                </foreignObject>
                            </g>
                        @endforeach
                        <circle cx="200" cy="200" r="80" fill="#fff" />
                        <image href="{{ asset('images/acpl-mark.webp') }}" x="150" y="155" width="100" height="91" />
                    </svg>
                </div>

                <div>
                    @foreach ($values as $value)
                        <div data-pick-panel="value:{{ $loop->index }}" @if (! $loop->first) hidden @endif>
                            <span class="font-display text-7xl text-gold-500/30">0{{ $loop->iteration }}</span>
                            <h3 class="mt-2 font-display text-5xl text-navy-900">{{ $value['title'] }}</h3>
                            <p class="mt-6 max-w-md text-xl leading-relaxed text-mist">{{ $value['text'] }}</p>
                        </div>
                    @endforeach

                    <ul class="mt-12 flex flex-wrap gap-2">
                        @foreach ($values as $value)
                            <li>
                                <button type="button" data-pick="value:{{ $loop->index }}" @class(['rounded-full border px-4 py-2 text-sm font-medium transition [&.is-active]:border-navy-900 [&.is-active]:bg-navy-900 [&.is-active]:text-white', 'is-active' => $loop->first, 'border-navy-900/15 text-navy-800 hover:border-navy-900/40'])>{{ $value['title'] }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <x-cta-band />
</x-layouts.app>
