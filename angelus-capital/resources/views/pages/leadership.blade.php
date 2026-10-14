<x-layouts.app title="Leadership" description="Meet the experienced leadership team of Angelus Capital Partners Limited.">
    <x-page-hero index="05" eyebrow="Leadership" title="Experienced <span class='text-gold-gradient'>leadership</span> team." lead="Decades of combined experience spanning banking, private equity, venture capital, investment management, governance and digital transformation." />

    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-8 md:grid-cols-2">
            @foreach (config('acpl.leadership') as $leader)
                <article class="card-light group relative overflow-hidden" data-reveal style="--reveal-delay: {{ ($loop->index % 2) * 120 }}ms">
                    <div class="on-dark relative isolate flex items-end gap-6 overflow-hidden bg-navy-900 p-8 sm:p-10">
                        <div class="grid-lines absolute inset-0 -z-10"></div>
                        <div class="absolute -top-20 -right-20 -z-10 size-64 rounded-full bg-navy-500/60 blur-3xl transition duration-700 group-hover:bg-gold-500/30"></div>

                        <div class="relative grid size-24 shrink-0 place-items-center rounded-full bg-gradient-to-br from-gold-300 via-gold-500 to-ember p-[2px] sm:size-28">
                            <span class="grid size-full place-items-center rounded-full bg-navy-950 font-display text-3xl text-gold-200 sm:text-4xl">{{ $leader['initials'] }}</span>
                        </div>
                        <div>
                            <p class="text-xs font-semibold tracking-[0.22em] text-gold-400 uppercase">{{ $leader['role'] }}</p>
                            <h2 class="mt-2 font-display text-3xl leading-tight text-white">{{ $leader['name'] }}</h2>
                        </div>
                    </div>
                    <div class="p-8 sm:p-10">
                        <p class="text-lg leading-relaxed text-mist">{{ $leader['bio'] }}</p>
                        <ul class="mt-8 flex flex-wrap gap-2">
                            @foreach ($leader['focus'] as $focus)
                                <li class="rounded-full bg-sand px-4 py-1.5 text-xs font-semibold text-navy-800">{{ $focus }}</li>
                            @endforeach
                        </ul>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="bg-white py-24 sm:py-32">
        <div class="container-x">
            <x-section-heading eyebrow="Why partner with ACPL" title="Experience you can build on." align="center" />
            <div class="mt-16 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (config('acpl.differentiators') as $item)
                    <div class="group flex gap-5 rounded-3xl border border-navy-900/8 p-8 transition duration-500 hover:border-gold-500/40 hover:bg-ivory" data-reveal style="--reveal-delay: {{ ($loop->index % 3) * 90 }}ms">
                        <span class="hex grid size-14 shrink-0 place-items-center bg-navy-900 font-display text-gold-300 transition group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950">0{{ $loop->iteration }}</span>
                        <div>
                            <h3 class="font-display text-xl text-navy-900">{{ $item['title'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-mist">{{ $item['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-band />
</x-layouts.app>
