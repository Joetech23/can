@props(['eyebrow', 'title', 'lead' => null, 'index' => null])

<section class="on-dark grain relative isolate overflow-hidden bg-navy-950 pt-40 pb-24 text-white sm:pt-48 sm:pb-32" data-tilt-area>
    <div class="grid-lines absolute inset-0 -z-10"></div>
    <div class="absolute -top-32 -right-32 -z-10 size-[36rem] rounded-full bg-navy-600/40 blur-[120px]"></div>
    <div class="absolute -bottom-40 left-1/4 -z-10 size-[28rem] rounded-full bg-ember/10 blur-[140px]"></div>
    <canvas data-ribbons="6" class="absolute inset-0 -z-10 h-full w-full opacity-70"></canvas>

    <img src="{{ asset('images/acpl-mark.webp') }}" alt="" width="317" height="288" data-tilt="14" class="pointer-events-none absolute top-1/2 right-[-6rem] -z-10 hidden w-[30rem] -translate-y-1/2 opacity-[0.13] lg:block">

    <div class="container-x">
        <div class="max-w-4xl">
            <div class="flex items-center gap-4" data-reveal>
                @if ($index)
                    <span class="font-display text-sm text-gold-400">{{ $index }}</span>
                @endif
                <span class="eyebrow">{{ $eyebrow }}</span>
            </div>
            <h1 class="mt-7 font-display text-5xl leading-[1.04] text-balance sm:text-6xl lg:text-7xl" data-reveal style="--reveal-delay: 100ms">{!! $title !!}</h1>
            @if ($lead)
                <p class="mt-8 max-w-2xl text-lg leading-relaxed text-white/65 sm:text-xl" data-reveal style="--reveal-delay: 200ms">{{ $lead }}</p>
            @endif
            {{ $slot }}
        </div>
    </div>
</section>
