@props(['eyebrow' => null, 'title', 'lead' => null, 'align' => 'left', 'dark' => false])

<div {{ $attributes->merge(['class' => ($align === 'center' ? 'mx-auto text-center items-center' : '').' flex max-w-3xl flex-col gap-5']) }}>
    @if ($eyebrow)
        <span class="eyebrow {{ $dark ? '!text-gold-400' : '' }}" data-reveal>{{ $eyebrow }}</span>
    @endif
    <h2 class="font-display text-4xl leading-[1.08] text-balance sm:text-5xl {{ $dark ? 'text-white' : 'text-navy-900' }}" data-reveal style="--reveal-delay: 80ms">{!! $title !!}</h2>
    @if ($lead)
        <p class="max-w-2xl text-lg leading-relaxed text-pretty {{ $dark ? 'text-white/65' : 'text-mist' }}" data-reveal style="--reveal-delay: 160ms">{{ $lead }}</p>
    @endif
</div>
