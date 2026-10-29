@props(['title' => null, 'description' => null])
@php($ft = config('fasttrack'))
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? $title.' · '.$ft['legal_name'] : $ft['legal_name'].' · Removals, Storage & Pallet Delivery' }}</title>
    <meta name="description" content="{{ $description ?? 'Fixed-price home and office removals, packing, storage, man and van and pallet delivery. Get an instant quote online and track your move.' }}">
    <meta name="theme-color" content="#101315">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $ft['legal_name'] }}">
    <meta property="og:title" content="{{ $title ? $title.' · ' : '' }}{{ $ft['legal_name'] }}">
    <meta property="og:description" content="{{ $description ?? 'Fixed-price removals, storage and pallet delivery. Instant quotes online.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="en_GB">
    <meta name="twitter:card" content="summary">
    @if (request()->routeIs('home'))
        <script type="application/ld+json">{!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'MovingCompany',
            'name' => $ft['legal_name'],
            'url' => url('/'),
            'logo' => asset('favicon.svg'),
            'telephone' => $ft['phone'],
            'email' => $ft['email'],
            'areaServed' => collect($ft['areas'])->pluck('name')->values(),
            'priceRange' => '££',
            'makesOffer' => collect($ft['services'])->map(fn ($s) => ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $s['name'], 'description' => $s['summary']]])->values(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    @endif
    {{ $head ?? '' }}
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-dvh flex-col">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] focus:rounded-md focus:bg-go-600 focus:px-4 focus:py-2 focus:font-semibold focus:text-white">Skip to content</a>

    @include('partials.site-header')

    <main id="main" class="flex-1">
        {{ $slot }}
    </main>

    @include('partials.site-footer')

    {{-- Desktop: WhatsApp chat button. --}}
    <a href="https://wa.me/{{ $ft['whatsapp'] }}" target="_blank" rel="noopener"
       class="group fixed right-6 bottom-6 z-40 hidden items-center gap-3 rounded-full bg-[#25d366] py-3 pr-5 pl-3 font-semibold text-ink-950 shadow-xl shadow-ink-950/20 transition hover:-translate-y-0.5 md:flex">
        <span class="grid size-9 place-items-center rounded-full bg-white/30"><x-icon name="message-circle" class="size-5" /></span>
        Chat on WhatsApp
    </a>

    {{-- Mobile action bar: the three things visitors want, always one tap away. --}}
    <nav class="fixed inset-x-0 bottom-0 z-40 grid grid-cols-3 border-t border-white/10 bg-ink-950 pb-[env(safe-area-inset-bottom)] md:hidden" aria-label="Quick contact">
        <a href="tel:{{ preg_replace('/\s+/', '', $ft['phone']) }}" class="flex flex-col items-center gap-1 py-2.5 font-condensed text-xs font-semibold tracking-wider text-white/80 uppercase">
            <x-icon name="phone" class="size-5" /> Call
        </a>
        <a href="https://wa.me/{{ $ft['whatsapp'] }}" class="flex flex-col items-center gap-1 border-x border-white/10 py-2.5 font-condensed text-xs font-semibold tracking-wider text-white/80 uppercase">
            <x-icon name="message-circle" class="size-5" /> WhatsApp
        </a>
        <a href="{{ route('quote') }}" class="flex flex-col items-center gap-1 bg-go-600 py-2.5 font-condensed text-xs font-bold tracking-wider text-white uppercase">
            <x-icon name="calculator" class="size-5" /> Instant quote
        </a>
    </nav>

    @include('partials.cookie-banner')
</body>
</html>
