@props(['fill' => '#001440'])

{{-- Navy swoosh with a gold leading edge, taken from the brand collateral. --}}
<svg {{ $attributes->merge(['class' => 'pointer-events-none block w-full']) }} viewBox="0 0 1440 120" preserveAspectRatio="none" aria-hidden="true">
    <defs>
        <linearGradient id="brand-wave-gold" x1="0" x2="1">
            <stop offset="0" stop-color="#b67a17" />
            <stop offset="0.45" stop-color="#f2d18a" />
            <stop offset="0.8" stop-color="#e8b654" />
            <stop offset="1" stop-color="#ef7d10" />
        </linearGradient>
    </defs>
    <path d="M0 120V96C320 62 640 112 960 84C1180 64 1330 26 1440 8V120Z" fill="{{ $fill }}" />
    <path d="M0 96C320 62 640 112 960 84C1180 64 1330 26 1440 8" fill="none" stroke="url(#brand-wave-gold)" stroke-width="5" />
</svg>
