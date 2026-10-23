<x-layouts.app title="Sectors & Transactions" description="ACPL's sectors of focus — financial services, hospitality, agribusiness, FMCG, healthcare and fintech — and the transaction credentials of our leadership team.">
    @php
        $sectors = config('acpl.sectors');
        $groups = config('acpl.transactions.groups');
        $dealCount = collect($groups)->sum(fn ($group) => count($group['deals']));
    @endphp

    <x-page-hero index="03" eyebrow="Sectors & transactions" title="Sector expertise, proven in <span class='text-gold-gradient'>transactions.</span>" lead="We focus on the sectors that will shape the continent’s next growth cycle — and our leadership has participated in transactions and investments across them.">
        <dl class="mt-12 grid max-w-2xl grid-cols-3 gap-6 border-t border-navy-900/10 pt-8" data-reveal style="--reveal-delay: 300ms">
            <div>
                <dt class="text-xs tracking-[0.2em] text-mist uppercase">Sectors</dt>
                <dd class="mt-2 font-display text-4xl text-navy-900" data-count="{{ count($sectors) }}">{{ count($sectors) }}</dd>
            </div>
            <div>
                <dt class="text-xs tracking-[0.2em] text-mist uppercase">Credentials</dt>
                <dd class="mt-2 font-display text-4xl text-navy-900" data-count="{{ $dealCount }}">{{ $dealCount }}</dd>
            </div>
            <div>
                <dt class="text-xs tracking-[0.2em] text-mist uppercase">Fundraising</dt>
                <dd class="mt-2 font-display text-4xl text-navy-900">$500M+</dd>
            </div>
        </dl>
        <div class="mt-10 flex flex-wrap gap-3" data-reveal style="--reveal-delay: 400ms">
            <a href="#sectors" class="btn-ghost !py-2.5">Sectors of focus</a>
            <a href="#transactions" class="btn-ghost !py-2.5">Transaction credentials</a>
        </div>
    </x-page-hero>

    <section id="sectors" class="scroll-mt-20 bg-ivory py-24 sm:py-32">
        <div class="container-x">
            <x-section-heading eyebrow="Sectors of focus" title="Deep knowledge where Africa is growing." />

            <div class="mt-14 grid grid-cols-1 gap-px overflow-hidden rounded-[2rem] border border-navy-900/8 bg-navy-900/8 sm:grid-cols-2">
                @foreach ($sectors as $sector)
                    <article class="group relative isolate flex min-h-80 flex-col justify-between overflow-hidden bg-white p-10 transition duration-700 hover:bg-navy-950 sm:p-12" data-reveal style="--reveal-delay: {{ ($loop->index % 2) * 100 }}ms">
                        <div class="absolute -right-24 -bottom-24 -z-10 size-72 rounded-full bg-gold-500/0 blur-3xl transition duration-700 group-hover:bg-gold-500/25"></div>
                        <div class="flex items-start justify-between">
                            <span class="grid size-16 place-items-center rounded-2xl bg-ivory text-gold-600 transition duration-500 group-hover:rotate-[-6deg] group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950">
                                <x-icon :name="$sector['icon']" class="size-8" />
                            </span>
                            <span class="font-display text-6xl text-navy-900/[0.06] transition group-hover:text-white/10">0{{ $loop->iteration }}</span>
                        </div>
                        <div>
                            <h2 class="font-display text-3xl text-navy-900 transition group-hover:text-white">{{ $sector['title'] }}</h2>
                            <p class="mt-3 max-w-sm text-lg leading-relaxed text-mist transition group-hover:text-white/65">{{ $sector['text'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="transactions" class="scroll-mt-20 bg-white py-24 sm:py-32">
        <div class="container-x">
            <x-section-heading eyebrow="Transaction experience" title="Selected transaction credentials." :lead="config('acpl.transactions.intro')" />

            <div class="sticky top-20 z-30 -mx-5 mt-12 mb-16 overflow-x-auto bg-white/90 px-5 py-4 backdrop-blur sm:mx-0 sm:rounded-full sm:px-2 sm:py-2" role="tablist" aria-label="Filter by sector" data-reveal>
                <div class="flex w-max gap-2">
                    <button type="button" role="tab" data-pick="deals:all" aria-selected="true" class="is-active rounded-full px-5 py-2.5 text-sm font-semibold whitespace-nowrap text-navy-800 transition hover:bg-ivory [&.is-active]:bg-navy-900 [&.is-active]:text-white">All sectors</button>
                    @foreach ($groups as $group)
                        <button type="button" role="tab" data-pick="deals:{{ $loop->index }}" aria-selected="false" class="rounded-full px-5 py-2.5 text-sm font-semibold whitespace-nowrap text-navy-800 transition hover:bg-ivory [&.is-active]:bg-navy-900 [&.is-active]:text-white">{{ $group['sector'] }}</button>
                    @endforeach
                </div>
            </div>

            @foreach (['all', ...array_keys($groups)] as $view)
                <div data-pick-panel="deals:{{ $view }}" @if ($view !== 'all') hidden @endif class="space-y-20">
                    @foreach ($groups as $index => $group)
                        @continue($view !== 'all' && $view !== $index)
                        <div>
                            <div class="flex items-center gap-4" data-reveal>
                                <span class="grid size-12 place-items-center rounded-2xl bg-navy-900 text-gold-300"><x-icon :name="$group['icon']" class="size-6" /></span>
                                <h2 class="font-display text-3xl text-navy-900">{{ $group['sector'] }}</h2>
                                <span class="h-px flex-1 bg-navy-900/10"></span>
                                <span class="text-sm text-mist">{{ count($group['deals']) }} {{ str('credential')->plural(count($group['deals'])) }}</span>
                            </div>

                            <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                                @foreach ($group['deals'] as $deal)
                                    {{-- Deal tombstone --}}
                                    <article class="group relative flex aspect-[4/5] flex-col items-center justify-between overflow-hidden rounded-[1.75rem] bg-navy-900 p-7 text-center text-white transition duration-500 hover:-translate-y-2 hover:shadow-[0_40px_60px_-30px_rgba(7,24,52,0.7)]" data-reveal style="--reveal-delay: {{ $loop->index * 80 }}ms">
                                        <span class="absolute inset-2.5 rounded-[1.3rem] border border-gold-400/25 transition duration-500 group-hover:border-gold-400/60"></span>
                                        <span class="absolute -top-16 left-1/2 size-40 -translate-x-1/2 rounded-full bg-gold-500/0 blur-3xl transition duration-700 group-hover:bg-gold-500/30"></span>
                                        <img src="{{ asset('images/acpl-logo-dark.webp') }}" alt="" width="600" height="566" class="relative mt-3 w-11 opacity-90">
                                        <div class="relative">
                                            <p class="font-display text-2xl leading-tight">{{ $deal['name'] }}</p>
                                            <span class="mx-auto my-4 block h-px w-10 bg-gold-400"></span>
                                            <p class="text-sm text-gold-200/85">{{ $deal['type'] }}</p>
                                        </div>
                                        <p class="relative mb-2 text-[0.6rem] tracking-[0.25em] text-white/40 uppercase">{{ $group['sector'] }}</p>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <p class="mt-16 text-sm text-mist" data-reveal>Credentials reflect transactions and investments in which members of the ACPL leadership team have participated.</p>
        </div>
    </section>

    <section class="on-dark relative overflow-hidden bg-navy-900 py-24 text-white sm:py-32">
        <div class="grid-lines absolute inset-0"></div>
        <div class="container-x relative grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
            <x-section-heading eyebrow="Investment strategies" title="How we deploy capital across these sectors." :lead="config('acpl.investment.philosophy')" dark />
            <div class="flex flex-wrap gap-3">
                @foreach (config('acpl.investment.strategies') as $strategy)
                    <span class="card-dark !rounded-full px-6 py-4 font-display text-xl text-white/90" data-reveal="zoom" style="--reveal-delay: {{ $loop->index * 80 }}ms">{{ $strategy }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-band page="sectors" />
</x-layouts.app>
