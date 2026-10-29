@props(['inverse' => false])
{{-- Placeholder mark: forward chevrons on a lane. Replace with FastTrack's own logo files when supplied. --}}
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5']) }}>
    <svg class="size-9 shrink-0" viewBox="0 0 40 40" aria-hidden="true">
        <rect width="40" height="40" rx="12" class="{{ $inverse ? 'fill-go-400' : 'fill-ink-900' }}"/>
        <path d="M11 13l7 7-7 7" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="{{ $inverse ? 'stroke-ink-950' : 'stroke-go-400' }}"/>
        <path d="M21 13l7 7-7 7" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="{{ $inverse ? 'stroke-ink-950/45' : 'stroke-go-400/45' }}"/>
    </svg>
    <span class="font-display text-[1.35rem] leading-none font-bold tracking-tight {{ $inverse ? 'text-white' : 'text-ink-950' }}">
        Fast<span class="{{ $inverse ? 'text-go-400' : 'text-go-700' }}">Track</span>
    </span>
</span>
