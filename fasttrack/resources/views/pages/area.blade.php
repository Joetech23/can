@php($ft = config('fasttrack'))
<x-layouts.site :title="'Removals in '.$area['name']" :description="'Removals, man and van, storage and pallet delivery in '.$area['name'].' ('.$area['postcodes'].'). Instant quotes, fixed prices and live tracking from FastTrack Team Logistics.'">
    <x-slot:head>
        <script type="application/ld+json">{!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'MovingCompany',
            'name' => $ft['legal_name'].' · '.$area['name'],
            'url' => url()->current(),
            'telephone' => $ft['phone'],
            'areaServed' => ['@type' => 'City', 'name' => $area['name']],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    </x-slot:head>

    <x-page-hero :eyebrow="$area['region'].' · '.$area['postcodes']" :title="'Removals in '.$area['name'].'.'" :lead="'Home and office removals, man and van, storage and pallet delivery across '.$area['name'].'. '.$area['note']" :crumbs="['Areas' => route('areas'), $area['name'] => null]">
        <form action="{{ route('quote') }}" method="get" class="mt-8 flex max-w-xl flex-col gap-2 rounded-lg bg-white p-2 sm:flex-row">
            <label class="flex-1">
                <span class="sr-only">Your postcode in {{ $area['name'] }}</span>
                <input name="from" required placeholder="Your {{ $area['name'] }} postcode" class="w-full rounded-md px-4 py-3 text-[15px] font-semibold text-ink-950 uppercase placeholder:font-normal placeholder:normal-case placeholder:text-ink-400 focus:ring-2 focus:ring-go-500 focus:outline-none">
            </label>
            <button class="btn-go">Instant quote <x-icon name="arrow-right" class="size-4" /></button>
        </form>
    </x-page-hero>

    <section class="py-16 lg:py-24">
        <div class="container-page">
            <x-section-head num="01" eyebrow="Services in {{ $area['name'] }}" title="Everything we move in {{ $area['name'] }}." />
            <div class="mt-10 grid gap-px overflow-hidden rounded-lg border border-ink-200 bg-ink-200 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($ft['services'] as $slug => $service)
                    <a href="{{ route('services.show', $slug) }}" class="group flex gap-4 bg-white p-6 transition hover:bg-ink-50">
                        <span class="grid size-11 shrink-0 place-items-center rounded-md bg-ink-950 text-white transition group-hover:bg-go-600"><x-icon :name="$service['icon']" /></span>
                        <span>
                            <span class="block font-semibold text-ink-950">{{ $service['name'] }} {{ $area['name'] }}</span>
                            <span class="mt-1 block text-sm text-ink-600">{{ $service['summary'] }}</span>
                            <span class="mt-2 block text-sm font-semibold text-go-600">{{ $service['from'] }}</span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-ink-950 py-16 text-white lg:py-20">
        <div class="container-page grid gap-10 lg:grid-cols-2 lg:items-center">
            <x-section-head num="02" eyebrow="Why FastTrack" :title="'Why '.$area['name'].' chooses FastTrack.'" dark />
            <ul class="grid gap-px overflow-hidden rounded-lg bg-white/10 sm:grid-cols-2">
                @foreach ([['clock', 'Local crews', 'Teams who know '.$area['name'].' streets, parking and access.'], ['pound-sterling', 'Fixed prices', 'Instant estimate, then a fixed quote in writing.'], ['navigation', 'Live tracking', 'Follow your move with your reference.'], ['shield-check', 'Fully insured', 'Goods in transit and public liability.']] as [$icon, $title, $body])
                    <li class="bg-ink-950 p-6"><x-icon :name="$icon" class="size-6 text-go-500" /><p class="mt-4 font-semibold">{{ $title }}</p><p class="mt-1 text-sm text-white/60">{{ $body }}</p></li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="py-16 lg:py-20">
        <div class="container-page grid gap-10 lg:grid-cols-[1fr_1.5fr]">
            <x-section-head eyebrow="FAQ" :title="'Moving in '.$area['name'].'.'" />
            @include('partials.faq', ['faqs' => [
                ['q' => 'Do you cover all of '.$area['name'].'?', 'a' => 'Yes. We cover '.$area['postcodes'].' and the surrounding area, plus moves from '.$area['name'].' to anywhere in the UK.'],
                ['q' => 'How much does a removal in '.$area['name'].' cost?', 'a' => 'Local moves start from '.$ft['services']['home-removals']['from'].' for a studio. Use the instant quote for a price range based on your postcodes and property size.'],
                ['q' => 'Can you handle parking and permits?', 'a' => 'Tell us about parking when you book. Where a suspension or permit is needed, we can advise how to arrange it with the council.'],
                ...array_slice($ft['faqs']['Booking'], 0, 1),
            ]])
        </div>
    </section>

    <section class="border-t border-ink-200 py-12">
        <div class="container-page">
            <h2 class="label-caps text-ink-500">Nearby areas</h2>
            <ul class="mt-4 flex flex-wrap gap-2">
                @foreach (collect($ft['areas'])->except($slug) as $otherSlug => $other)
                    <li><a href="{{ route('areas.show', $otherSlug) }}" class="chip hover:border-ink-950"><x-icon name="map-pin" class="size-3.5 text-go-600" /> Removals {{ $other['name'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-cta-band :title="'Moving in '.$area['name'].'?'" />
</x-layouts.site>
