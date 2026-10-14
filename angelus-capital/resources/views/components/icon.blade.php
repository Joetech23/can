@props(['name', 'stroke' => 1.5])

@php
    $paths = [
        'bank' => '<path d="M3 10h18M5 10v8m4.67-8v8m4.66-8v8M19 10v8M3 21h18M12 3l9 5H3l9-5Z"/>',
        'hotel' => '<path d="M3 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16M15 9h4a2 2 0 0 1 2 2v10M3 21h18M7 7h1m3 0h1M7 11h1m3 0h1M7 15h1m3 0h1m6-2h1m-1 4h1"/>',
        'leaf' => '<path d="M5 21c0-9 5-15 15-16-1 10-7 15-15 16Zm0 0 8-8"/>',
        'basket' => '<path d="m4 10 2.2 9.1A2 2 0 0 0 8.1 21h7.8a2 2 0 0 0 1.9-1.9L20 10M2 10h20M8 10l3-7m5 7-3-7M9 14v3m6-3v3"/>',
        'health' => '<path d="M12 21s-8-4.6-8-11a4.5 4.5 0 0 1 8-2.9A4.5 4.5 0 0 1 20 10c0 6.4-8 11-8 11Z"/><path d="M8 12h2l1.5-2.5 2 5L15 12h1.5"/>',
        'chip' => '<rect x="6" y="6" width="12" height="12" rx="2"/><path d="M9.5 9.5h5v5h-5zM9 2v4m6-4v4M9 18v4m6-4v4M2 9h4m-4 6h4m12-6h4m-4 6h4"/>',
        'sun' => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32 1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>',
        'bridge' => '<path d="M2 17h20M4 17V9m16 8V9M2 9h20M4 9c3 0 5 4 8 4s5-4 8-4M8 17v-4.2m8 4.2v-4.2"/>',
        'compass' => '<circle cx="12" cy="12" r="9"/><path d="m15.5 8.5-2 5-5 2 2-5 5-2Z"/>',
        'coins' => '<ellipse cx="9" cy="7" rx="6" ry="3"/><path d="M3 7v5c0 1.66 2.69 3 6 3s6-1.34 6-3V7"/><path d="M3 12v5c0 1.66 2.69 3 6 3 1.3 0 2.5-.2 3.5-.6M15 13.4c3.4.3 6 1.6 6 3.1 0 1.7-3 3-6.5 3"/>',
        'chart' => '<path d="M3 3v18h18"/><path d="m7 15 4-4 3 3 6-7"/><path d="M16 7h4v4"/>',
        'shield' => '<path d="M12 3 4 6v6c0 5 3.4 8.3 8 9 4.6-.7 8-4 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/>',
        'network' => '<circle cx="12" cy="5" r="2.5"/><circle cx="5" cy="18" r="2.5"/><circle cx="19" cy="18" r="2.5"/><path d="M10.8 7.2 6.2 15.8m7-8.6 4.6 8.6M7.5 18h9"/>',
        'target' => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
        'scale' => '<path d="M12 3v18M7 21h10M5 7h14M5 7l-3 7a3 3 0 0 0 6 0L5 7Zm14 0-3 7a3 3 0 0 0 6 0l-3-7Z"/>',
        'handshake' => '<path d="m11 17 2 2a1.4 1.4 0 0 0 2-2m-4-2 2.5 2.5a1.4 1.4 0 0 0 2-2L13 13m-5 6-1.5-1.5M3 13l3.5-6.5L10 7l2.5-1.5L16 6l2 0 3 6.5-3.5 3"/><path d="m12.5 5.5-3 3a1.4 1.4 0 0 0 2 2l2-2 4.5 4.5"/>',
        'globe' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',
        'layers' => '<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 13 9 5 9-5"/>',
        'users' => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0M16 4.6a3.5 3.5 0 0 1 0 6.8M18 14.5a6.5 6.5 0 0 1 3.5 5.5"/>',
        'sparkle' => '<path d="M12 3c.5 4.5 2.5 6.5 7 7-4.5.5-6.5 2.5-7 7-.5-4.5-2.5-6.5-7-7 4.5-.5 6.5-2.5 7-7Z"/>',
        'quote' => '<path d="M9.5 6C6.5 7.2 4.5 9.8 4.5 13.5V18h5v-5h-3c0-2.4 1.2-4 3.5-5L9.5 6Zm10 0c-3 1.2-5 3.8-5 7.5V18h5v-5h-3c0-2.4 1.2-4 3.5-5L19.5 6Z"/>',
        'arrow-right' => '<path d="M5 12h14m-6-6 6 6-6 6"/>',
        'arrow-up-right' => '<path d="M7 17 17 7M8 7h9v9"/>',
        'phone' => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/>',
        'mail' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'pin' => '<path d="M12 21s-7-6.2-7-12a7 7 0 0 1 14 0c0 5.8-7 12-7 12Z"/><circle cx="12" cy="9" r="2.5"/>',
        'check' => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
        'plus' => '<path d="M12 5v14M5 12h14"/>',
        'menu' => '<path d="M4 8h16M4 16h10"/>',
        'close' => '<path d="M6 6l12 12M18 6 6 18"/>',
        'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'linkedin' => '<rect x="3" y="3" width="18" height="18" rx="3"/><path d="M8 10v7M8 7v.01M12 17v-4a2 2 0 0 1 4 0v4m-4-7v7"/>',
    ];
@endphp

<svg {{ $attributes->merge(['class' => 'size-5 shrink-0']) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $paths[$name] ?? $paths['sparkle'] !!}</svg>
