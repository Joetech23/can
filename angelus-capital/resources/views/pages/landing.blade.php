<x-layouts.app title="Raise Capital & Grow with Confidence" description="Confidential advisory, capital solutions and investments. Speak with the experienced team at Angelus Capital Partners in Lagos." bare noindex>
    @php
        $company = config('acpl.company');
        $landing = config('acpl.landing');
        $leaders = config('acpl.leadership');
        $platformIcons = ['advisory' => 'compass', 'capital' => 'coins', 'investments' => 'chart'];
        $credentials = collect(config('acpl.transactions.groups'))
            ->flatMap(fn ($group) => collect($group['deals'])->map(fn ($deal) => $deal + ['sector' => $group['sector'], 'icon' => $group['icon']]));
    @endphp

    {{-- Slim header --}}
    <header data-header class="fixed inset-x-0 top-0 z-50 border-b border-transparent bg-white/85 transition-all duration-500">
        <div data-header-inner class="container-x flex items-center justify-between gap-4 py-4 transition-all duration-500">
            <a href="{{ route('home') }}" aria-label="{{ $company['name'] }}"><x-logo compact /></a>
            <div class="flex items-center gap-3">
                <a href="tel:{{ $company['phone_href'] }}" class="hidden items-center gap-2 text-sm font-semibold text-navy-900 transition hover:text-gold-700 md:inline-flex">
                    <x-icon name="phone" class="size-4 text-gold-600" /> {{ $company['phone'] }}
                </a>
                <a href="#questionnaire" class="btn-gold hidden !px-5 !py-2.5 sm:inline-flex">Get a consultation</a>
            </div>
        </div>
    </header>

    {{-- Hero + consultation card --}}
    <section class="relative isolate overflow-hidden bg-white pt-32 pb-24 sm:pt-36 lg:pb-32">
        <div class="brand-lines absolute inset-0 -z-10"></div>
        <div class="absolute top-[-20%] right-[-10%] -z-10 size-[44rem] rounded-full bg-gold-200/45 blur-[140px]"></div>
        <canvas data-ribbons="10" data-tone="light" class="absolute inset-0 -z-10 h-full w-full"></canvas>

        <div class="container-x grid grid-cols-1 items-start gap-14 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
            <div class="lg:pt-8">
                <span class="eyebrow" data-reveal>{{ $company['tagline'] }}</span>
                <h1 class="mt-7 font-display text-[2.4rem] leading-[1.08] text-balance text-navy-900 sm:text-5xl xl:text-[3.4rem]" data-reveal style="--reveal-delay: 80ms">{!! $landing['title'] !!}</h1>
                <p class="mt-7 max-w-xl text-lg leading-relaxed text-mist" data-reveal style="--reveal-delay: 160ms">{{ $landing['lead'] }}</p>

                <ul class="mt-9 space-y-4" data-reveal style="--reveal-delay: 240ms">
                    @foreach ($landing['points'] as $point)
                        <li class="flex items-start gap-3 text-navy-900">
                            <span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-full bg-gradient-to-br from-gold-300 to-ember text-navy-950"><x-icon name="check" class="size-3.5" stroke="2.5" /></span>
                            <span><strong class="font-semibold">{{ \Illuminate\Support\Str::before($point, ':') }}:</strong>{{ \Illuminate\Support\Str::after($point, ':') }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-12 grid max-w-xl grid-cols-3 gap-4 border-t border-navy-900/10 pt-8" data-reveal style="--reveal-delay: 320ms">
                    @foreach ($landing['stats'] as $stat)
                        <div>
                            <p class="font-display text-2xl text-navy-900 sm:text-4xl">{{ $stat['value'] }}</p>
                            <p class="mt-1 text-xs leading-snug text-mist">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Next step card: everything routes to the contact page --}}
            <div data-reveal="zoom" style="--reveal-delay: 150ms">
                <div class="relative rounded-[2rem] bg-gradient-to-br from-gold-300 via-gold-500 to-ember p-[2px] shadow-[0_40px_80px_-35px_rgba(0,20,64,0.55)]">
                    <div class="rounded-[calc(2rem-2px)] bg-white p-7 text-ink sm:p-9">
                        <p class="text-xs font-semibold tracking-[0.22em] text-gold-600 uppercase">Confidential</p>
                        <h2 class="mt-2 font-display text-3xl leading-tight text-navy-900">Book a consultation</h2>
                        <p class="mt-2 text-sm text-mist">Choose what you need and we’ll route you to the right team.</p>

                        <ul class="mt-6 space-y-2.5">
                            @foreach (config('acpl.enquiry_types') as $type => $label)
                                @continue($type === 'other')
                                <li>
                                    <a href="{{ route('contact', ['enquiry' => $type]) }}#enquire" class="group flex items-center justify-between gap-4 rounded-2xl border border-navy-900/10 px-5 py-3.5 font-medium text-navy-900 transition hover:border-gold-500 hover:bg-ivory">
                                        {{ $label }}
                                        <x-icon name="arrow-right" class="size-4 text-gold-600 transition group-hover:translate-x-1" stroke="2" />
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <a href="#questionnaire" class="btn-gold mt-6 w-full !py-4 text-base">Answer 5 quick questions <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
                        <p class="mt-4 flex items-center justify-center gap-2 text-xs text-mist"><x-icon name="shield" class="size-4 text-gold-600" /> Your details are kept confidential.</p>
                    </div>
                </div>
            </div>
        </div>

        <x-brand-wave class="absolute inset-x-0 bottom-0 h-12 sm:h-16" />
    </section>

    {{-- Credentials strip --}}
    <section class="bg-navy-900 py-8" aria-label="Selected transaction credentials">
        <div class="container-x">
            <p class="text-center text-xs tracking-[0.25em] text-white/50 uppercase">Our leadership has participated in transactions including</p>
        </div>
        <div class="mt-6 overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
            <div class="flex w-max animate-marquee gap-12 whitespace-nowrap" style="animation-duration: 55s">
                @foreach ([0, 1] as $copy)
                    @foreach ($credentials as $deal)
                        <span class="flex items-center gap-3 font-display text-xl text-white/80" @if ($copy) aria-hidden="true" @endif>
                            <x-icon :name="$deal['icon']" class="size-5 text-gold-400" /> {{ $deal['name'] }}
                        </span>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    {{-- How we help: the three integrated platforms --}}
    <section class="bg-ivory py-20 sm:py-28">
        <div class="container-x">
            <x-section-heading :eyebrow="$landing['help']['eyebrow']" :title="$landing['help']['title']" :lead="$landing['help']['lead']" align="center" />

            <div class="mt-14 grid grid-cols-1 gap-6 lg:grid-cols-3">
                @foreach (config('acpl.platforms') as $platform)
                    <article id="{{ $platform['key'] }}" class="card-light relative flex flex-col overflow-hidden p-8 sm:p-10" data-reveal style="--reveal-delay: {{ $loop->index * 120 }}ms">
                        <span class="absolute top-0 left-8 h-1 w-16 rounded-b-full bg-gradient-to-r from-gold-400 to-ember"></span>
                        <div class="flex items-center justify-between">
                            <span class="grid size-14 place-items-center rounded-2xl bg-navy-900 text-gold-300"><x-icon :name="$platformIcons[$platform['key']]" class="size-7" /></span>
                            <span class="text-xs font-semibold tracking-[0.2em] text-gold-600 uppercase">Platform 0{{ $loop->iteration }}</span>
                        </div>
                        <h3 class="mt-7 font-display text-3xl text-navy-900">{{ $platform['title'] }}</h3>
                        <p class="mt-3 text-mist">{{ $platform['summary'] }}</p>
                        <ul class="mt-7 flex-1 space-y-3">
                            @foreach ($platform['items'] as $item)
                                <li class="flex items-start gap-3 text-navy-800"><x-icon name="check" class="mt-1 size-4 shrink-0 text-gold-600" stroke="2" /> {{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- E-invoicing: a compliance service of the Advisory platform --}}
    <section id="einvoice" class="scroll-mt-20 bg-white py-20 sm:py-28">
        <div class="container-x">
            <div class="on-dark grain relative isolate overflow-hidden rounded-[2.5rem] bg-navy-900 p-8 text-white sm:p-14" data-reveal="zoom">
                <div class="absolute -top-24 -right-24 -z-10 size-96 rounded-full bg-gold-500/25 blur-[100px]"></div>
                <div class="grid-lines absolute inset-0 -z-10"></div>
                <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-[1.2fr_0.8fr]">
                    <div>
                        <span class="inline-flex items-center gap-2 rounded-full bg-gold-400/15 px-3 py-1 text-xs font-semibold tracking-wider text-gold-300 uppercase"><x-icon name="document" class="size-4" /> Advisory platform · Compliance</span>
                        <h2 class="mt-6 font-display text-4xl leading-tight text-balance sm:text-5xl">{{ config('acpl.einvoice.title') }}</h2>
                        <p class="mt-5 max-w-xl text-lg leading-relaxed text-white/70">{{ config('acpl.einvoice.summary') }}</p>
                        <ul class="mt-8 space-y-3">
                            @foreach (config('acpl.einvoice.points') as $point)
                                <li class="flex items-start gap-3 text-white/85"><x-icon name="check" class="mt-1 size-4 text-gold-400" stroke="2.5" /> {{ $point }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-dark p-7 text-center sm:p-9">
                        <x-icon name="document" class="mx-auto size-12 text-gold-300" stroke="1.2" />
                        <p class="mt-5 font-display text-2xl">Is your business ready?</p>
                        <p class="mt-2 text-sm text-white/60">Talk to our compliance advisory team.</p>
                        <a href="{{ route('contact', ['enquiry' => 'einvoice']) }}#enquire" class="btn-gold mt-7 w-full">Get e-invoicing advice <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Engagement process --}}
    <section class="on-dark relative overflow-hidden bg-navy-900 py-20 text-white sm:py-28">
        <div class="grid-lines absolute inset-0"></div>
        <div class="container-x relative">
            <x-section-heading :eyebrow="$landing['process']['eyebrow']" :title="$landing['process']['title']" align="center" dark />
            <ol class="mt-14 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($landing['process']['steps'] as $step)
                    <li class="card-dark relative p-7" data-reveal style="--reveal-delay: {{ $loop->index * 90 }}ms">
                        <span class="font-display text-5xl text-gold-400/70">0{{ $loop->iteration }}</span>
                        <h3 class="mt-5 font-display text-xl">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-white/60">{{ $step['text'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Leadership --}}
    <section class="bg-white py-20 sm:py-28">
        <div class="container-x">
            <x-section-heading eyebrow="Your advisers" title="Experienced people. Proven track record." lead="Our leadership brings decades of experience across venture capital, private equity, banking, audit, pensions and corporate governance." align="center" />
            <div class="mt-14 grid grid-cols-1 gap-10 sm:grid-cols-3">
                @foreach ($leaders as $leader)
                    <div class="text-center" data-reveal style="--reveal-delay: {{ $loop->index * 110 }}ms">
                        <x-portrait :leader="$leader" class="mx-auto w-full max-w-56" />
                        <p class="mt-6 font-display text-2xl text-navy-900">{{ $leader['name'] }}</p>
                        <p class="mt-1 text-xs font-semibold tracking-[0.22em] text-gold-600 uppercase">{{ $leader['role'] }}</p>
                        <p class="mx-auto mt-4 max-w-xs text-sm leading-relaxed text-mist">{{ rtrim(\Illuminate\Support\Str::before($leader['bio'], '. '), '.') }}.</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Quote --}}
    <section class="bg-sand py-20 sm:py-24">
        <figure class="container-x mx-auto max-w-4xl text-center" data-reveal>
            <x-icon name="quote" class="mx-auto size-10 text-gold-500" stroke="1" />
            <blockquote class="mt-6 font-serif text-3xl leading-snug text-navy-900 italic sm:text-4xl">“{{ config('acpl.chairman.pull_quote') }}”</blockquote>
            <figcaption class="mt-8 flex items-center justify-center gap-4">
                <img src="{{ asset(config('acpl.chairman.photo')) }}" alt="" width="56" height="56" loading="lazy" class="size-14 rounded-full object-cover object-top ring-2 ring-gold-400 ring-offset-2 ring-offset-sand">
                <span class="text-left">
                    <span class="block font-semibold text-navy-900">{{ config('acpl.chairman.name') }}</span>
                    <span class="block text-sm text-mist">{{ config('acpl.chairman.title') }}</span>
                </span>
            </figcaption>
        </figure>
    </section>

    {{-- Pre-consultation questionnaire: answers continue to the contact form --}}
    <section id="questionnaire" class="scroll-mt-20 bg-ivory py-20 sm:py-28">
        <div class="container-x grid grid-cols-1 gap-12 lg:grid-cols-[0.75fr_1.25fr]">
            <div>
                <x-section-heading eyebrow="Before we talk" title="Help us understand your needs." lead="Five quick questions so the right adviser comes to your consultation prepared. It takes under a minute — your answers go straight to our team with your enquiry." />
                <p class="mt-8 flex items-center gap-2 text-sm text-mist" data-reveal><x-icon name="shield" class="size-4 text-gold-600" /> Confidential. No obligation.</p>
            </div>

            <form method="GET" action="{{ route('contact') }}#enquire" class="card-light p-7 sm:p-10" data-reveal="right">
                <fieldset>
                    <legend class="font-display text-xl text-navy-900"><span class="mr-2 text-gold-600">01</span> What do you need help with?</legend>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach (config('acpl.enquiry_types') as $type => $label)
                            <label class="cursor-pointer">
                                <input type="radio" name="enquiry" value="{{ $type }}" class="peer sr-only" @checked($loop->first)>
                                <span class="block rounded-full border border-navy-900/15 bg-white px-4 py-2.5 text-sm text-navy-800 transition peer-checked:border-navy-900 peer-checked:bg-navy-900 peer-checked:text-white peer-focus-visible:ring-4 peer-focus-visible:ring-gold-400/40 hover:border-navy-900/40">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                @foreach (config('acpl.questionnaire') as $key => $question)
                    <fieldset class="mt-8">
                        <legend class="font-display text-xl text-navy-900"><span class="mr-2 text-gold-600">0{{ $loop->iteration + 1 }}</span> {{ $question['label'] }}</legend>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($question['options'] as $option)
                                <label class="cursor-pointer">
                                    <input type="radio" name="q[{{ $key }}]" value="{{ $option }}" class="peer sr-only">
                                    <span class="block rounded-full border border-navy-900/15 bg-white px-4 py-2.5 text-sm text-navy-800 transition peer-checked:border-navy-900 peer-checked:bg-navy-900 peer-checked:text-white peer-focus-visible:ring-4 peer-focus-visible:ring-gold-400/40 hover:border-navy-900/40">{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                @endforeach

                <div class="mt-10 flex flex-col gap-4 border-t border-navy-900/8 pt-8 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xs text-mist">Next: add your contact details.</p>
                    <button type="submit" class="btn-gold">Continue to book <x-icon name="arrow-right" class="size-4" stroke="2" /></button>
                </div>
            </form>
        </div>
    </section>

    {{-- Final CTA: start from the problem --}}
    <section class="on-dark grain relative isolate overflow-hidden bg-navy-900 py-20 text-center text-white sm:py-28">
        <div class="absolute top-1/2 left-1/2 -z-10 size-[36rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-gold-500/15 blur-[120px]"></div>
        <canvas data-ribbons="5" class="absolute inset-0 -z-10 h-full w-full opacity-60"></canvas>
        <div class="container-x">
            <img src="{{ asset('images/acpl-logo-dark.webp') }}" alt="" width="600" height="566" class="mx-auto w-24 drop-shadow-[0_20px_40px_rgba(239,125,16,0.35)]" data-reveal="zoom">
            <h2 class="mx-auto mt-8 max-w-3xl font-display text-4xl leading-tight text-balance sm:text-5xl" data-reveal>{{ $landing['final']['title'] }}</h2>
            <p class="mx-auto mt-5 max-w-2xl text-lg text-white/70" data-reveal>{{ $landing['final']['lead'] }}</p>
            <ul class="mx-auto mt-8 flex max-w-2xl flex-wrap justify-center gap-2.5" data-reveal>
                @foreach ($landing['final']['points'] as $point)
                    <li class="flex items-center gap-2 rounded-full border border-gold-400/30 bg-white/[0.04] px-4 py-2 text-sm text-white/85"><span class="size-1.5 rounded-full bg-gold-400"></span>{{ $point }}</li>
                @endforeach
            </ul>
            <div class="mt-10 flex flex-wrap justify-center gap-4" data-reveal>
                <a href="#questionnaire" class="btn-gold">Tell us your challenge <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
                <a href="tel:{{ $company['phone_href'] }}" class="btn-outline"><x-icon name="phone" class="size-4" /> {{ $company['phone'] }}</a>
            </div>
        </div>
    </section>

    {{-- Slim footer --}}
    <footer class="border-t border-white/10 bg-navy-900 pt-10 pb-28 text-sm text-white/55 sm:pb-10">
        <div class="container-x flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">
            <p>&copy; {{ now()->year }} {{ $company['name'] }} · {{ implode(', ', $company['address']) }}</p>
            <a href="{{ route('home') }}" class="text-gold-400 transition hover:text-gold-300">Visit our website →</a>
        </div>
    </footer>

    {{-- Sticky mobile action bar --}}
    <div class="fixed inset-x-0 bottom-0 z-40 grid grid-cols-2 gap-2 border-t border-navy-900/10 bg-white/95 p-3 backdrop-blur sm:hidden">
        <a href="tel:{{ $company['phone_href'] }}" class="btn-ghost !px-4 !py-3"><x-icon name="phone" class="size-4" /> Call us</a>
        <a href="#questionnaire" class="btn-gold !px-4 !py-3">Get started</a>
    </div>
</x-layouts.app>
