@php($ft = config('fasttrack'))
<x-layouts.site title="Areas we cover" description="Removals, storage and pallet delivery across London, Kent, Essex, Surrey and the UK. Find your local FastTrack crew.">
    <x-page-hero eyebrow="Areas" title="Local crews, UK-wide reach." lead="Our crews work across the South East every day, and we move homes and freight anywhere in the UK." :crumbs="['Areas' => null]" />

    <section class="py-16 lg:py-24">
        <div class="container-page">
            <div class="grid gap-px overflow-hidden rounded-lg border border-ink-200 bg-ink-200 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($ft['areas'] as $slug => $area)
                    <a href="{{ route('areas.show', $slug) }}" class="group flex flex-col bg-white p-7 transition hover:bg-ink-950" x-reveal="{{ ($loop->index % 3) * 60 }}">
                        <div class="flex items-center justify-between">
                            <span class="grid size-11 place-items-center rounded-md bg-go-100 text-go-600 transition group-hover:bg-go-600 group-hover:text-white"><x-icon name="map-pin" /></span>
                            <span class="label-caps text-ink-400 transition group-hover:text-white/40">{{ $area['postcodes'] }}</span>
                        </div>
                        <h2 class="mt-5 text-2xl text-ink-950 transition group-hover:text-white">Removals {{ $area['name'] }}</h2>
                        <p class="mt-1 text-sm font-semibold text-go-600 transition group-hover:text-go-400">{{ $area['region'] }}</p>
                        <p class="mt-3 flex-1 text-ink-600 transition group-hover:text-white/65">{{ $area['note'] }}</p>
                        <span class="mt-5 flex items-center gap-1 font-condensed text-sm font-bold tracking-wider text-ink-950 uppercase transition group-hover:text-white">View area <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" /></span>
                    </a>
                @endforeach
            </div>
            <p class="mt-8 text-center text-ink-600">Not on the list? We still cover you. <a href="{{ route('quote') }}" class="font-semibold text-go-600 underline underline-offset-4">Get a quote for any UK address</a>.</p>
        </div>
    </section>

    <x-cta-band />
</x-layouts.site>
