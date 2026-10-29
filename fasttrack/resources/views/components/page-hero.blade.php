@props(['eyebrow', 'title', 'lead' => null])
<section class="relative overflow-hidden border-b border-ink-100 bg-ink-50/50">
    <div class="pointer-events-none absolute -top-40 right-0 size-[520px] rounded-full bg-go-200/50 blur-3xl"></div>
    <div class="container-page relative py-16 lg:py-24">
        <p class="eyebrow"><span class="h-px w-6 bg-go-600"></span> {{ $eyebrow }}</p>
        <h1 class="mt-4 max-w-3xl text-4xl leading-[1.05] font-extrabold text-ink-950 sm:text-6xl">{{ $title }}</h1>
        @if ($lead)
            <p class="mt-5 max-w-2xl text-lg leading-relaxed text-ink-600">{{ $lead }}</p>
        @endif
        {{ $slot }}
    </div>
</section>
