@php($ft = config('fasttrack'))
<x-layouts.site title="Services" description="Home and office removals, packing, storage, man and van, student moves, clearances and European moves.">
    <x-page-hero eyebrow="Services" title="Everything your move needs, from one crew." lead="Pick one service or bundle them. Either way you get one coordinator, one fixed price and one team who knows the plan." />

    <section class="py-16 lg:py-24">
        <div class="container-page grid gap-5 md:grid-cols-2">
            @foreach ($ft['services'] as $slug => $service)
                <article class="group card flex flex-col p-7 transition hover:border-go-300 hover:shadow-xl hover:shadow-go-900/5 sm:p-8" x-reveal="{{ ($loop->index % 2) * 80 }}">
                    <div class="flex items-start justify-between gap-4">
                        <span class="grid size-14 place-items-center rounded-2xl bg-go-100 text-go-800 ring-1 ring-go-200 transition group-hover:bg-go-400 group-hover:text-ink-950"><x-icon :name="$service['icon']" class="size-7" /></span>
                        <span class="rounded-full bg-ink-50 px-3 py-1 text-sm font-semibold text-ink-800">{{ $service['from'] }}</span>
                    </div>
                    <h2 class="mt-6 text-2xl font-bold text-ink-950">{{ $service['name'] }}</h2>
                    <p class="mt-2 leading-relaxed text-ink-600">{{ $service['summary'] }}</p>
                    <ul class="mt-5 grid flex-1 gap-2 sm:grid-cols-2">
                        @foreach ($service['points'] as $point)
                            <li class="flex gap-2 text-sm text-ink-700"><x-icon name="check" class="mt-0.5 size-4 shrink-0 text-go-600" /> {{ $point }}</li>
                        @endforeach
                    </ul>
                    <div class="mt-7 flex flex-wrap gap-3">
                        <a href="{{ route('quote', ['service' => $slug]) }}" class="btn-go">Get a quote</a>
                        <a href="{{ route('services.show', $slug) }}" class="btn-ghost">Learn more <x-icon name="arrow-right" class="size-4" /></a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</x-layouts.site>
