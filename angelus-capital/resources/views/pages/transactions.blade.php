<x-layouts.app title="Transaction Experience" description="Selected transaction credentials of the ACPL leadership team across banking, hospitality, technology, agribusiness and infrastructure.">
    @php($groups = config('acpl.transactions.groups'))

    <x-page-hero index="04" eyebrow="Transaction experience" title="Selected transaction <span class='text-gold-gradient'>credentials.</span>" :lead="config('acpl.transactions.intro')">
        <dl class="mt-12 grid max-w-2xl grid-cols-3 gap-6 border-t border-white/10 pt-8" data-reveal style="--reveal-delay: 300ms">
            <div>
                <dt class="text-xs tracking-[0.2em] text-white/45 uppercase">Credentials</dt>
                <dd class="mt-2 font-display text-4xl text-gold-300" data-count="{{ collect($groups)->sum(fn ($group) => count($group['deals'])) }}">{{ collect($groups)->sum(fn ($group) => count($group['deals'])) }}</dd>
            </div>
            <div>
                <dt class="text-xs tracking-[0.2em] text-white/45 uppercase">Sectors</dt>
                <dd class="mt-2 font-display text-4xl text-gold-300" data-count="{{ count($groups) }}">{{ count($groups) }}</dd>
            </div>
            <div>
                <dt class="text-xs tracking-[0.2em] text-white/45 uppercase">Raised</dt>
                <dd class="mt-2 font-display text-4xl text-gold-300">$500M+</dd>
            </div>
        </dl>
    </x-page-hero>

    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x">
            <div class="sticky top-20 z-30 -mx-5 mb-16 overflow-x-auto bg-ivory/90 px-5 py-4 backdrop-blur sm:mx-0 sm:rounded-full sm:px-2 sm:py-2" role="tablist" aria-label="Filter by sector" data-reveal>
                <div class="flex w-max gap-2">
                    <button type="button" role="tab" data-pick="deals:all" aria-selected="true" class="is-active rounded-full px-5 py-2.5 text-sm font-semibold whitespace-nowrap text-navy-800 transition hover:bg-white [&.is-active]:bg-navy-900 [&.is-active]:text-white">All sectors</button>
                    @foreach ($groups as $group)
                        <button type="button" role="tab" data-pick="deals:{{ $loop->index }}" aria-selected="false" class="rounded-full px-5 py-2.5 text-sm font-semibold whitespace-nowrap text-navy-800 transition hover:bg-white [&.is-active]:bg-navy-900 [&.is-active]:text-white">{{ $group['sector'] }}</button>
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
                                        <img src="{{ asset('images/acpl-mark.webp') }}" alt="" width="317" height="288" class="relative mt-3 w-10 opacity-80">
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

    <x-cta-band title="Your transaction could be next." />
</x-layouts.app>
