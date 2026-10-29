@php($ft = config('fasttrack'))
<x-layouts.site :title="$guide['title']" :description="$guide['summary']">
    <x-slot:head>
        <script type="application/ld+json">{!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $guide['title'],
            'description' => $guide['summary'],
            'publisher' => ['@type' => 'Organization', 'name' => $ft['legal_name']],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    </x-slot:head>
    <x-page-hero :eyebrow="'Guide · '.$guide['minutes'].' min read'" :title="$guide['title']" :lead="$guide['summary']" :crumbs="['Moving guides' => route('guides'), $guide['title'] => null]" />

    <section class="py-14 lg:py-20">
        <div class="container-page grid gap-12 lg:grid-cols-[1fr_320px]">
            <article class="prose-ft max-w-3xl">
                @include('guides.'.$slug)
            </article>
            <aside class="space-y-5 lg:sticky lg:top-36 lg:self-start">
                <div class="overflow-hidden rounded-lg bg-ink-950 text-white">
                    <div class="h-1 bg-go-500"></div>
                    <div class="p-6">
                        <h2 class="text-xl">Moving soon?</h2>
                        <p class="mt-2 text-sm font-light text-white/65">See your price in two minutes with our instant quote.</p>
                        <a href="{{ route('quote') }}" class="btn-go mt-5 w-full">Instant quote</a>
                    </div>
                </div>
                <div class="rounded-lg border border-ink-200 p-6">
                    <h2 class="label-caps text-ink-500">More guides</h2>
                    <ul class="mt-3 divide-y divide-ink-200">
                        @foreach (collect($ft['guides'])->except($slug) as $otherSlug => $other)
                            <li><a href="{{ route('guides.show', $otherSlug) }}" class="block py-3 font-medium text-ink-800 hover:text-go-600">{{ $other['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </section>
</x-layouts.site>
