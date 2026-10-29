@props(['eyebrow', 'title', 'lead' => null, 'crumbs' => []])
<section class="relative overflow-hidden bg-ink-950 text-white">
    <x-speed-lines class="pointer-events-none absolute -right-10 top-1/2 hidden h-[130%] -translate-y-1/2 text-white/[0.03] lg:block" />
    <div class="container-page relative py-14 lg:py-20">
        @if ($crumbs)
            <nav aria-label="Breadcrumb" class="mb-6 flex flex-wrap items-center gap-2 text-sm text-white/50">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                @foreach ($crumbs as $label => $url)
                    <x-icon name="chevron-right" class="size-3.5" />
                    @if ($url) <a href="{{ $url }}" class="hover:text-white">{{ $label }}</a> @else <span class="text-white/80" aria-current="page">{{ $label }}</span> @endif
                @endforeach
            </nav>
        @endif
        <p class="eyebrow text-go-400">{{ $eyebrow }}</p>
        <h1 class="mt-4 max-w-3xl text-4xl leading-[1.05] font-bold sm:text-6xl">{{ $title }}</h1>
        @if ($lead)
            <p class="mt-5 max-w-2xl text-lg leading-relaxed font-light text-white/70">{{ $lead }}</p>
        @endif
        {{ $slot }}
    </div>
</section>
