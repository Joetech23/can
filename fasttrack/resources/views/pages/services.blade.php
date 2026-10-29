@php($ft = config('fasttrack'))
<x-layouts.site title="Services" description="Home removals, office moves, packing, storage, man and van and pallet delivery from FastTrack Team Logistics.">
    <x-page-hero eyebrow="Services" title="Everything that needs moving, moved." lead="Six services from one team. Book one, or bundle them with one coordinator and one fixed price." :crumbs="['Services' => null]" />

    <section class="py-16 lg:py-24">
        <div class="container-page space-y-5">
            @foreach ($ft['services'] as $slug => $service)
                <article class="group grid overflow-hidden rounded-lg border border-ink-200 transition hover:border-ink-950 lg:grid-cols-[280px_1fr_auto]" x-reveal>
                    <div class="relative flex items-center gap-4 overflow-hidden bg-ink-950 p-7 text-white lg:flex-col lg:items-start lg:justify-between">
                        <x-speed-lines class="absolute -right-20 top-0 h-full text-white/[0.05]" />
                        <span class="relative font-condensed text-5xl font-bold text-go-500">0{{ $loop->iteration }}</span>
                        <span class="relative grid size-14 place-items-center rounded-md bg-white/10"><x-icon :name="$service['icon']" class="size-7" /></span>
                    </div>
                    <div class="p-7 sm:p-8">
                        <h2 class="text-2xl text-ink-950">{{ $service['name'] }}</h2>
                        <p class="mt-2 max-w-2xl leading-relaxed text-ink-600">{{ $service['intro'] }}</p>
                        <ul class="mt-5 grid gap-x-6 gap-y-2 sm:grid-cols-2 xl:grid-cols-3">
                            @foreach (array_slice($service['points'], 0, 6) as $point)
                                <li class="flex gap-2 text-sm text-ink-700"><x-icon name="check" class="mt-0.5 size-4 shrink-0 text-go-600" /> {{ $point }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="flex flex-row items-center justify-between gap-3 border-t border-ink-200 p-7 lg:flex-col lg:items-stretch lg:justify-center lg:border-t-0 lg:border-l">
                        <p class="text-lg font-bold text-ink-950 lg:text-center">{{ $service['from'] }}</p>
                        <div class="flex gap-2 lg:flex-col">
                            <a href="{{ route('quote', ['service' => $slug]) }}" class="btn-go whitespace-nowrap">Instant quote</a>
                            <a href="{{ route('services.show', $slug) }}" class="btn-ghost whitespace-nowrap">Details</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <x-cta-band title="Not sure which service you need?" lead="Tell us what's moving and we'll recommend the right crew, van and price." />
</x-layouts.site>
