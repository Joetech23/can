@php($ft = config('fasttrack'))
<x-layouts.site title="Reviews" description="Read what customers say about FastTrack Team Logistics removals, storage and pallet delivery.">
    <x-page-hero eyebrow="Reviews" title="Moved by FastTrack." lead="Every finished job gets a review request. Here is what customers say about their move." :crumbs="['Reviews' => null]">
        @if ($ft['google_reviews_url'])
            <a href="{{ $ft['google_reviews_url'] }}" target="_blank" rel="noopener" class="btn-line mt-8">Read us on Google <x-icon name="external-link" class="size-4" /></a>
        @endif
    </x-page-hero>

    <section class="py-16 lg:py-24">
        <div class="container-page">
            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($ft['reviews'] as $review)
                    <div x-reveal="{{ ($loop->index % 3) * 80 }}">@include('partials.review-card', ['review' => $review])</div>
                @endforeach
            </div>

            <div class="mt-14 grid gap-6 rounded-lg border border-ink-200 bg-ink-50 p-8 md:grid-cols-[1fr_auto] md:items-center">
                <div>
                    <h2 class="text-2xl text-ink-950">Moved with us recently?</h2>
                    <p class="mt-2 text-ink-600">We'd love to hear how it went. Reviews help other people choose a mover they can trust.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    @if ($ft['google_reviews_url'])
                        <a href="{{ $ft['google_reviews_url'] }}" target="_blank" rel="noopener" class="btn-ink">Leave a Google review</a>
                    @endif
                    <a href="{{ route('contact') }}" class="btn-ghost">Send us feedback</a>
                </div>
            </div>
        </div>
    </section>

    <x-cta-band />
</x-layouts.site>
