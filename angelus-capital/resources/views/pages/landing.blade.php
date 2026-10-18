<x-layouts.app title="Raise Capital & Grow with Confidence" description="Confidential advisory on capital raising, project finance, M&A and investments. Speak with the experienced team at Angelus Capital Partners in Lagos." bare noindex>
    @php
        $company = config('acpl.company');
        $leaders = config('acpl.leadership');
        $credentials = collect(config('acpl.transactions.groups'))
            ->flatMap(fn ($group) => collect($group['deals'])->map(fn ($deal) => $deal + ['sector' => $group['sector'], 'icon' => $group['icon']]));
        $faqs = [
            ['q' => 'What kinds of organizations do you work with?', 'a' => 'Corporations and SMEs, project sponsors, institutional investors, pension funds, family offices, development finance institutions, government agencies, high-net-worth individuals and investment consortia.'],
            ['q' => 'What types of capital can you help us raise?', 'a' => 'Equity capital, debt financing, mezzanine capital, structured finance and alternative capital solutions — matched to your stage, sector and objectives, and sourced from institutional investors, DFIs, commercial banks, private equity funds, family offices, strategic and impact investors.'],
            ['q' => 'Which sectors do you focus on?', 'a' => 'Financial services, hospitality, agribusiness, fast moving consumer goods, healthcare and fintech.'],
            ['q' => 'Do you work outside Nigeria?', 'a' => 'We are based in Lagos, and our leadership has participated in transactions and investments across multiple sectors and geographies in West Africa, including Nigeria, Côte d’Ivoire, Liberia and Sierra Leone.'],
            ['q' => 'Is my enquiry confidential?', 'a' => 'Yes. We treat every enquiry in confidence.'],
            ['q' => 'What happens after I submit the form?', 'a' => 'A member of our team reviews your enquiry and contacts you to arrange an initial, no-obligation conversation about your objectives.'],
        ];
    @endphp

    {{-- Slim header --}}
    <header data-header class="fixed inset-x-0 top-0 z-50 border-b border-transparent transition-all duration-500">
        <div data-header-inner class="container-x flex items-center justify-between gap-4 py-4 transition-all duration-500">
            <a href="{{ route('home') }}" aria-label="{{ $company['name'] }}"><x-logo compact /></a>
            <div class="flex items-center gap-3">
                <a href="tel:{{ $company['phone_href'] }}" class="hidden items-center gap-2 text-sm font-semibold text-white/80 transition hover:text-gold-300 md:inline-flex">
                    <x-icon name="phone" class="size-4 text-gold-400" /> {{ $company['phone'] }}
                </a>
                <a href="{{ route('contact') }}#enquire" class="btn-gold hidden !px-5 !py-2.5 sm:inline-flex">Get a consultation</a>
            </div>
        </div>
    </header>

    {{-- Hero + form --}}
    <section class="on-dark grain relative isolate overflow-hidden bg-navy-950 pt-32 pb-20 text-white sm:pt-36 lg:pb-28">
        <div class="grid-lines absolute inset-0 -z-10"></div>
        <div class="absolute top-[-20%] right-[-10%] -z-10 size-[48rem] rounded-full bg-navy-600/45 blur-[140px]"></div>
        <div class="absolute bottom-[-30%] left-[-10%] -z-10 size-[36rem] rounded-full bg-gold-500/10 blur-[140px]"></div>
        <canvas data-ribbons="8" class="absolute inset-0 -z-10 h-full w-full"></canvas>

        <div class="container-x grid grid-cols-1 items-start gap-14 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
            <div class="lg:pt-8">
                <span class="eyebrow" data-reveal>{{ $company['tagline'] }}</span>
                <h1 class="mt-7 font-display text-[2.6rem] leading-[1.05] text-balance sm:text-6xl" data-reveal style="--reveal-delay: 80ms">
                    Raise capital. Structure the deal. <span class="text-gold-gradient">Grow with confidence.</span>
                </h1>
                <p class="mt-7 max-w-xl text-lg leading-relaxed text-white/70" data-reveal style="--reveal-delay: 160ms">
                    Angelus Capital Partners helps businesses, investors and institutions unlock growth through innovative financing, strategic advisory and disciplined investment execution.
                </p>

                <ul class="mt-9 space-y-4" data-reveal style="--reveal-delay: 240ms">
                    @foreach ([
                        'Equity, debt, mezzanine and structured finance',
                        'Bankable project structuring and financial modeling',
                        'M&A support, due diligence and investor readiness',
                        'Independent advice aligned with your interests',
                    ] as $point)
                        <li class="flex items-start gap-3 text-white/85">
                            <span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-full bg-gradient-to-br from-gold-300 to-ember text-navy-950"><x-icon name="check" class="size-3.5" stroke="2.5" /></span>
                            {{ $point }}
                        </li>
                    @endforeach
                </ul>

                <div class="mt-12 grid max-w-xl grid-cols-3 gap-4 border-t border-white/10 pt-8" data-reveal style="--reveal-delay: 320ms">
                    <div>
                        <p class="font-display text-2xl text-gold-300 sm:text-4xl">$500M+</p>
                        <p class="mt-1 text-xs leading-snug text-white/55">Fundraising our MD &amp; CEO has participated in</p>
                    </div>
                    <div>
                        <p class="font-display text-2xl text-gold-300 sm:text-4xl">30+</p>
                        <p class="mt-1 text-xs leading-snug text-white/55">Years of leadership experience</p>
                    </div>
                    <div>
                        <p class="font-display text-2xl text-gold-300 sm:text-4xl">3</p>
                        <p class="mt-1 text-xs leading-snug text-white/55">Integrated platforms</p>
                    </div>
                </div>
            </div>

            {{-- Next step card: everything routes to the contact page --}}
            <div data-reveal="zoom" style="--reveal-delay: 150ms">
                <div class="relative rounded-[2rem] bg-gradient-to-br from-gold-300 via-gold-500 to-ember p-[2px] shadow-[0_40px_80px_-30px_rgba(0,0,0,0.7)]">
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

                        <a href="{{ route('contact') }}#enquire" class="btn-gold mt-6 w-full !py-4 text-base">Start a conversation <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
                        <p class="mt-4 flex items-center justify-center gap-2 text-xs text-mist"><x-icon name="shield" class="size-4 text-gold-600" /> Your details are kept confidential.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Credentials strip --}}
    <section class="border-y border-gold-500/20 bg-navy-900 py-8" aria-label="Selected transaction credentials">
        <div class="container-x">
            <p class="text-center text-xs tracking-[0.25em] text-white/45 uppercase">Our leadership has participated in transactions including</p>
        </div>
        <div class="mt-6 overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
            <div class="flex w-max animate-marquee gap-12 whitespace-nowrap" style="animation-duration: 55s">
                @foreach ([0, 1] as $copy)
                    @foreach ($credentials as $deal)
                        <span class="flex items-center gap-3 font-display text-xl text-white/75" @if ($copy) aria-hidden="true" @endif>
                            <x-icon :name="$deal['icon']" class="size-5 text-gold-400" /> {{ $deal['name'] }}
                        </span>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    {{-- Who we help --}}
    <section class="bg-ivory py-20 sm:py-28">
        <div class="container-x">
            <x-section-heading eyebrow="How we help" title="One partner for both sides of the capital equation." align="center" />

            <div class="mt-14 grid grid-cols-1 gap-6 lg:grid-cols-2">
                @foreach ([
                    ['icon' => 'chart', 'title' => 'Businesses & project sponsors', 'lead' => 'You need the right capital, in the right structure, from the right partners.', 'items' => ['Capital raising: equity, debt, mezzanine and structured finance', 'Project structuring, financial modeling and risk allocation', 'M&A support, valuation and transaction execution', 'Restructuring, turnaround and business transformation']],
                    ['icon' => 'coins', 'title' => 'Investors & institutions', 'lead' => 'You need quality opportunities, properly diligenced and well structured.', 'items' => ['Access to vetted opportunities across key growth sectors', 'Due diligence, feasibility studies and investor readiness', 'Private equity, growth capital, infrastructure and impact investments', 'Governance and operational value creation after investment']],
                ] as $audience)
                    <article class="card-light p-8 sm:p-10" data-reveal style="--reveal-delay: {{ $loop->index * 120 }}ms">
                        <span class="grid size-14 place-items-center rounded-2xl bg-navy-900 text-gold-300"><x-icon :name="$audience['icon']" class="size-7" /></span>
                        <h3 class="mt-7 font-display text-3xl text-navy-900">{{ $audience['title'] }}</h3>
                        <p class="mt-3 text-lg text-mist">{{ $audience['lead'] }}</p>
                        <ul class="mt-7 space-y-3">
                            @foreach ($audience['items'] as $item)
                                <li class="flex items-start gap-3 text-navy-800"><x-icon name="check" class="mt-1 size-4 text-gold-600" stroke="2" /> {{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- E-invoice campaign --}}
    <section id="einvoice" class="scroll-mt-20 bg-white py-20 sm:py-28">
        <div class="container-x">
            <div class="on-dark grain relative isolate overflow-hidden rounded-[2.5rem] bg-navy-900 p-8 text-white sm:p-14" data-reveal="zoom">
                <div class="absolute -top-24 -right-24 -z-10 size-96 rounded-full bg-gold-500/25 blur-[100px]"></div>
                <div class="grid-lines absolute inset-0 -z-10"></div>
                <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-[1.2fr_0.8fr]">
                    <div>
                        <span class="inline-flex items-center gap-2 rounded-full bg-gold-400/15 px-3 py-1 text-xs font-semibold tracking-wider text-gold-300 uppercase"><x-icon name="document" class="size-4" /> Compliance advisory</span>
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
                        <a href="{{ route('contact', ['enquiry' => 'einvoice']) }}#enquire" class="btn-gold mt-7 w-full">Get e-invoice advice <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section class="on-dark relative overflow-hidden bg-navy-950 py-20 text-white sm:py-28">
        <div class="grid-lines absolute inset-0"></div>
        <div class="container-x relative">
            <x-section-heading eyebrow="How it works" title="From first conversation to completed transaction." align="center" dark />
            <ol class="mt-14 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['title' => 'Confidential consultation', 'text' => 'We listen to your objectives, timelines and constraints.'],
                    ['title' => 'Assessment & structuring', 'text' => 'Due diligence, financial modeling and the right capital structure.'],
                    ['title' => 'Capital mobilisation', 'text' => 'We engage institutional, strategic and impact capital providers.'],
                    ['title' => 'Execution & beyond', 'text' => 'We move the transaction to completion and support long-term value creation.'],
                ] as $step)
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

    {{-- FAQ --}}
    <section class="bg-ivory py-20 sm:py-28">
        <div class="container-x grid grid-cols-1 gap-12 lg:grid-cols-[0.8fr_1.2fr]">
            <x-section-heading eyebrow="Questions" title="Good to know before we talk." />
            <div class="divide-y divide-navy-900/10 border-y border-navy-900/10">
                @foreach ($faqs as $faq)
                    <details class="group py-6" @if ($loop->first) open @endif>
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-6 font-display text-xl text-navy-900 [&::-webkit-details-marker]:hidden">
                            {{ $faq['q'] }}
                            <span class="grid size-9 shrink-0 place-items-center rounded-full border border-navy-900/15 text-gold-600 transition duration-300 group-open:rotate-45 group-open:bg-navy-900 group-open:text-gold-300"><x-icon name="plus" class="size-4" stroke="2" /></span>
                        </summary>
                        <p class="mt-4 max-w-2xl leading-relaxed text-mist">{{ $faq['a'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="on-dark grain relative isolate overflow-hidden bg-navy-900 py-20 text-center text-white sm:py-28">
        <div class="absolute top-1/2 left-1/2 -z-10 size-[36rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-gold-500/15 blur-[120px]"></div>
        <canvas data-ribbons="5" class="absolute inset-0 -z-10 h-full w-full opacity-60"></canvas>
        <div class="container-x">
            <img src="{{ asset('images/acpl-mark.webp') }}" alt="" width="317" height="288" class="mx-auto w-24 drop-shadow-[0_20px_40px_rgba(239,125,16,0.4)]" data-reveal="zoom">
            <h2 class="mx-auto mt-8 max-w-3xl font-display text-4xl leading-tight text-balance sm:text-5xl" data-reveal>Ready to unlock your next stage of growth?</h2>
            <p class="mx-auto mt-5 max-w-xl text-lg text-white/65" data-reveal>Book a confidential consultation with our team.</p>
            <div class="mt-10 flex flex-wrap justify-center gap-4" data-reveal>
                <a href="{{ route('contact') }}#enquire" class="btn-gold">Request a consultation <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
                <a href="tel:{{ $company['phone_href'] }}" class="btn-outline"><x-icon name="phone" class="size-4" /> {{ $company['phone'] }}</a>
            </div>
        </div>
    </section>

    {{-- Slim footer --}}
    <footer class="bg-navy-950 pt-10 pb-28 text-sm text-white/50 sm:pb-10">
        <div class="container-x flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">
            <p>&copy; {{ now()->year }} {{ $company['name'] }} · {{ implode(', ', $company['address']) }}</p>
            <a href="{{ route('home') }}" class="text-gold-400 transition hover:text-gold-300">Visit our website →</a>
        </div>
    </footer>

    {{-- Sticky mobile action bar --}}
    <div class="fixed inset-x-0 bottom-0 z-40 grid grid-cols-2 gap-2 border-t border-white/10 bg-navy-950/95 p-3 backdrop-blur sm:hidden">
        <a href="tel:{{ $company['phone_href'] }}" class="btn-outline !px-4 !py-3"><x-icon name="phone" class="size-4" /> Call us</a>
        <a href="{{ route('contact') }}#enquire" class="btn-gold !px-4 !py-3">Get started</a>
    </div>
</x-layouts.app>
