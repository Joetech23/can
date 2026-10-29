@php($ft = config('fasttrack'))
<x-layouts.site :title="$service['name']" :description="$service['summary'].' Instant quotes and live tracking from FastTrack Team Logistics.'">
    <x-slot:head>
        <script type="application/ld+json">{!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $service['name'],
            'description' => $service['intro'],
            'provider' => ['@type' => 'MovingCompany', 'name' => $ft['legal_name'], 'telephone' => $ft['phone']],
            'areaServed' => collect($ft['areas'])->pluck('name')->values(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    </x-slot:head>

    <x-page-hero :eyebrow="'Services · '.$service['name']" :title="$service['name'].'.'" :lead="$service['intro']" :crumbs="['Services' => route('services'), $service['name'] => null]">
        <div class="mt-8 flex flex-wrap items-center gap-3">
            <a href="{{ route('quote', ['service' => $slug]) }}" class="btn-go">Get an instant quote <x-icon name="arrow-right" class="size-4" /></a>
            <a href="tel:{{ preg_replace('/\s+/', '', $ft['phone']) }}" class="btn-line"><x-icon name="phone" class="size-4" /> {{ $ft['phone'] }}</a>
            <span class="ml-2 font-condensed text-lg font-bold tracking-wide text-go-400 uppercase">{{ $service['from'] }}</span>
        </div>
    </x-page-hero>

    <section class="py-16 lg:py-24">
        <div class="container-page grid gap-12 lg:grid-cols-[1.4fr_1fr]">
            <div>
                <x-section-head num="01" eyebrow="What's included" title="Everything handled, start to finish." />
                <ul class="mt-8 grid gap-3 sm:grid-cols-2">
                    @foreach ($service['points'] as $point)
                        <li class="flex items-start gap-3 rounded-lg border border-ink-200 p-4" x-reveal="{{ ($loop->index % 2) * 60 }}">
                            <span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-sm bg-go-600 text-white"><x-icon name="check" class="size-3.5" /></span>
                            <span class="font-medium text-ink-800">{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-16">
                    <x-section-head num="02" eyebrow="Ideal for" title="Who books this." />
                    <div class="mt-8 grid gap-px overflow-hidden rounded-lg bg-ink-200 sm:grid-cols-3">
                        @foreach ($service['ideal'] as $ideal)
                            <div class="bg-ink-50 p-5"><span class="font-condensed text-2xl font-bold text-go-600">0{{ $loop->iteration }}</span><p class="mt-2 font-semibold text-ink-950">{{ $ideal }}</p></div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-16">
                    <x-section-head num="03" eyebrow="How it works" title="Three steps to moving day." />
                    <ol class="mt-8 space-y-5">
                        @foreach ($ft['steps'] as $i => $step)
                            <li class="flex gap-5">
                                <span class="grid size-12 shrink-0 place-items-center rounded-md bg-ink-950 font-condensed text-xl font-bold text-white">0{{ $i + 1 }}</span>
                                <span>
                                    <span class="block text-lg font-semibold text-ink-950">{{ $step['title'] }}</span>
                                    <span class="mt-1 block text-ink-600">{{ $step['body'] }}</span>
                                </span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>

            <aside class="space-y-5 lg:sticky lg:top-36 lg:self-start">
                <div class="overflow-hidden rounded-lg bg-ink-950 text-white">
                    <div class="h-1 bg-go-500"></div>
                    <div class="p-7">
                        <x-icon :name="$service['icon']" class="size-9 text-go-500" />
                        <h2 class="mt-5 text-2xl">See your price now.</h2>
                        <p class="mt-2 font-light text-white/65">Instant estimate from our rate card, fixed quote {{ $ft['response_time'] }}.</p>
                        <a href="{{ route('quote', ['service' => $slug]) }}" class="btn-go mt-6 w-full">Start my quote <x-icon name="arrow-right" class="size-4" /></a>
                        <ul class="mt-6 space-y-2.5 border-t border-white/10 pt-6 text-sm text-white/70">
                            @foreach ($ft['trust'] as $item)
                                <li class="flex items-center gap-2"><x-icon :name="$item['icon']" class="size-4 text-go-500" /> {{ $item['label'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="rounded-lg border border-ink-200 p-6">
                    <h2 class="label-caps text-ink-500">Other services</h2>
                    <ul class="mt-3 divide-y divide-ink-200">
                        @foreach (collect($ft['services'])->except($slug) as $otherSlug => $other)
                            <li><a href="{{ route('services.show', $otherSlug) }}" class="flex items-center justify-between py-3 font-medium text-ink-800 hover:text-go-600"><span class="flex items-center gap-2.5"><x-icon :name="$other['icon']" class="size-4 text-go-600" /> {{ $other['name'] }}</span><x-icon name="chevron-right" class="size-4" /></a></li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </section>

    <section class="border-t border-ink-200 bg-ink-50 py-16 lg:py-20">
        <div class="container-page grid gap-10 lg:grid-cols-[1fr_1.5fr]">
            <x-section-head eyebrow="FAQ" :title="$service['name'].' questions.'" />
            @include('partials.faq', ['faqs' => array_merge($service['faqs'], array_slice($ft['faqs']['Prices'], 0, 1), array_slice($ft['faqs']['Insurance & storage'], 0, 1))])
        </div>
    </section>

    <section class="py-14">
        <div class="container-page">
            <h2 class="label-caps text-ink-500">{{ $service['name'] }} near you</h2>
            <ul class="mt-4 flex flex-wrap gap-2">
                @foreach ($ft['areas'] as $areaSlug => $area)
                    <li><a href="{{ route('areas.show', $areaSlug) }}" class="chip hover:border-ink-950">{{ $service['name'] }} in {{ $area['name'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-cta-band :service="$slug" />
</x-layouts.site>
