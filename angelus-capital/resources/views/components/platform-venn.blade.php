{{-- The three integrated platforms, in order, overlapping around ACPL. --}}
<div {{ $attributes->merge(['class' => 'relative']) }}>
    <svg viewBox="0 0 400 380" class="w-full" role="img" aria-label="Advisory, Capital Solutions and Investments overlapping around ACPL">
        <defs>
            <radialGradient id="eco-a" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="#e8b654" stop-opacity="0.32" /><stop offset="100%" stop-color="#e8b654" stop-opacity="0.04" /></radialGradient>
            <radialGradient id="eco-b" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="#ef7d10" stop-opacity="0.3" /><stop offset="100%" stop-color="#ef7d10" stop-opacity="0.04" /></radialGradient>
            <radialGradient id="eco-c" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="#2f5893" stop-opacity="0.65" /><stop offset="100%" stop-color="#2f5893" stop-opacity="0.08" /></radialGradient>
        </defs>
        <g class="transition-opacity duration-500">
            <circle cx="200" cy="130" r="112" fill="url(#eco-a)" stroke="#e8b654" stroke-opacity="0.55" />
            <circle cx="135" cy="245" r="112" fill="url(#eco-c)" stroke="#f2d18a" stroke-opacity="0.35" />
            <circle cx="265" cy="245" r="112" fill="url(#eco-b)" stroke="#ef7d10" stroke-opacity="0.5" />
        </g>
        <text x="200" y="88" text-anchor="middle" fill="#fff" font-size="17" font-family="var(--font-marcellus)">Advisory</text>
        <text x="95" y="285" text-anchor="middle" fill="#fff" font-size="17" font-family="var(--font-marcellus)">Capital</text>
        <text x="95" y="305" text-anchor="middle" fill="#fff" font-size="17" font-family="var(--font-marcellus)">Solutions</text>
        <text x="305" y="295" text-anchor="middle" fill="#fff" font-size="17" font-family="var(--font-marcellus)">Investments</text>
        <circle cx="200" cy="208" r="38" fill="#001440" stroke="#e8b654" stroke-width="1.5" />
        <text x="200" y="214" text-anchor="middle" fill="#f2d18a" font-size="17" letter-spacing="2" font-family="var(--font-marcellus)">ACPL</text>
    </svg>
</div>
