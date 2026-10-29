@php($ft = config('fasttrack'))
<x-layouts.site title="FAQ" description="Answers to common questions about booking, prices, moving day, insurance and storage with FastTrack Team Logistics.">
    <x-slot:head>
        <script type="application/ld+json">{!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($ft['faqs'])->flatten(1)->map(fn ($f) => ['@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']]])->values(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    </x-slot:head>
    <x-page-hero eyebrow="FAQ" title="Questions, answered." lead="Everything people usually ask before they book. Still stuck? Call {{ $ft['phone'] }} or message us on WhatsApp." :crumbs="['FAQ' => null]" />

    <section class="py-16 lg:py-24">
        <div class="container-page grid gap-12 lg:grid-cols-[240px_1fr]">
            <nav class="hidden lg:block" aria-label="FAQ topics">
                <ul class="sticky top-36 space-y-1 border-l-2 border-ink-200">
                    @foreach (array_keys($ft['faqs']) as $topic)
                        <li><a href="#{{ Str::slug($topic) }}" class="-ml-0.5 block border-l-2 border-transparent py-1.5 pl-4 font-condensed text-[15px] font-semibold tracking-wider text-ink-600 uppercase hover:border-go-500 hover:text-ink-950">{{ $topic }}</a></li>
                    @endforeach
                </ul>
            </nav>
            <div class="space-y-14">
                @foreach ($ft['faqs'] as $topic => $faqs)
                    <section id="{{ Str::slug($topic) }}" class="scroll-mt-36">
                        <h2 class="label-caps rule mb-2 text-go-600">0{{ $loop->iteration }} · {{ $topic }}</h2>
                        @include('partials.faq', ['faqs' => $faqs])
                    </section>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-band />
</x-layouts.site>
