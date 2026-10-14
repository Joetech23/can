<x-layouts.app title="Sectors of Focus" description="Sector expertise across financial services, hospitality, agribusiness, FMCG, healthcare, fintech, green energy and infrastructure.">
    @php($sectors = config('acpl.sectors'))

    <x-page-hero index="03" eyebrow="Sectors of focus" title="Sector expertise where Africa is <span class='text-gold-gradient'>growing.</span>" lead="Our leadership has advised, raised capital for and invested in businesses across eight sectors that will shape the continent’s next growth cycle." />

    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x">
            <div class="grid grid-cols-1 gap-px overflow-hidden rounded-[2rem] border border-navy-900/8 bg-navy-900/8 sm:grid-cols-2">
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

    <x-cta-band title="Operating in one of these sectors?" lead="Speak with our team about advisory support, capital raising or investment partnership." />
</x-layouts.app>
