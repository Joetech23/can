<x-layouts.app :title="$leader['name'].' — '.$leader['role']" :description="$leader['intro']">
    {{-- Profile hero --}}
    <section class="on-dark grain relative isolate overflow-hidden bg-navy-950 pt-36 pb-20 text-white sm:pt-44 sm:pb-28">
        <div class="grid-lines absolute inset-0 -z-10"></div>
        <div class="absolute -top-32 -right-32 -z-10 size-[36rem] rounded-full bg-navy-600/40 blur-[120px]"></div>
        <canvas data-ribbons="6" class="absolute inset-0 -z-10 h-full w-full opacity-60"></canvas>

        <div class="container-x">
            <a href="{{ route('leadership') }}" class="inline-flex items-center gap-2 text-sm text-white/60 transition hover:text-gold-300" data-reveal>
                <x-icon name="arrow-right" class="size-4 rotate-180" stroke="2" /> All leadership
            </a>

            <div class="mt-10 grid grid-cols-1 items-center gap-12 lg:grid-cols-[18rem_1fr] lg:gap-16">
                <x-portrait :leader="$leader" eager class="w-full max-w-72" data-reveal="zoom" />

                <div>
                    <span class="eyebrow" data-reveal>{{ $leader['role'] }}</span>
                    <h1 class="mt-6 font-display text-5xl leading-[1.05] sm:text-6xl" data-reveal style="--reveal-delay: 100ms">{{ $leader['name'] }}</h1>
                    <p class="mt-8 max-w-3xl text-lg leading-relaxed text-white/70" data-reveal style="--reveal-delay: 200ms">{{ $leader['intro'] }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Key areas of expertise --}}
    <section class="bg-ivory py-20 sm:py-24">
        <div class="container-x grid grid-cols-1 gap-12 lg:grid-cols-[0.8fr_1.2fr]">
            <x-section-heading eyebrow="Key areas of expertise" title="Where experience runs deepest." />
            <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                @foreach ($leader['expertise'] as $area)
                    <li class="card-light flex items-start gap-4 p-6" data-reveal style="--reveal-delay: {{ $loop->index * 80 }}ms">
                        <span class="hex grid size-11 shrink-0 place-items-center bg-navy-900 font-display text-sm text-gold-300">0{{ $loop->iteration }}</span>
                        <span class="pt-2 font-medium leading-snug text-navy-900">{{ $area }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Professional milestone highlights --}}
    <section class="bg-white py-20 sm:py-28">
        <div class="container-x">
            <x-section-heading eyebrow="Professional milestone highlights" :title="'A career in three chapters.'" />

            <div class="mt-14 grid grid-cols-1 gap-6 lg:grid-cols-3">
                @foreach ($leader['milestones'] as $milestone)
                    <article class="relative flex flex-col overflow-hidden rounded-3xl border border-navy-900/8 bg-ivory p-8" data-reveal style="--reveal-delay: {{ $loop->index * 110 }}ms">
                        <span class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-gold-400 to-ember"></span>
                        <span class="font-display text-5xl text-gold-500/40">0{{ $loop->iteration }}</span>
                        <h3 class="mt-4 font-display text-2xl leading-snug text-navy-900">{{ $milestone['title'] }}</h3>
                        <p class="mt-4 font-serif text-lg leading-snug text-navy-800 italic">{{ $milestone['lead'] }}</p>
                        <ul class="mt-6 space-y-5 border-t border-navy-900/10 pt-6">
                            @foreach ($milestone['items'] as $item)
                                <li class="text-sm leading-relaxed text-mist">
                                    <strong class="block font-semibold text-navy-900">{{ $item['label'] }}</strong>
                                    {{ $item['text'] }}
                                </li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Colleagues --}}
    <section class="bg-sand py-20 sm:py-24">
        <div class="container-x">
            <x-section-heading eyebrow="The leadership team" title="Meet the rest of the team." />
            <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2">
                @foreach ($colleagues as $colleague)
                    <a href="{{ route('leadership.show', $colleague['slug']) }}" class="card-light group flex items-center gap-6 p-5 transition duration-500 hover:-translate-y-1" data-reveal style="--reveal-delay: {{ $loop->index * 100 }}ms">
                        <x-portrait :leader="$colleague" class="w-24 shrink-0 !rounded-2xl sm:w-28" />
                        <div class="min-w-0">
                            <p class="text-xs font-semibold tracking-[0.2em] text-gold-600 uppercase">{{ $colleague['role'] }}</p>
                            <p class="mt-1 font-display text-2xl text-navy-900">{{ $colleague['name'] }}</p>
                            <span class="link-arrow mt-3">View profile <x-icon name="arrow-right" class="size-4" stroke="2" /></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-band />
</x-layouts.app>
