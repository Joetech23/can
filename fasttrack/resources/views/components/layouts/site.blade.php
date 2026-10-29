@props(['title' => null, 'description' => null])
@php($ft = config('fasttrack'))
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? $title.' · ' : '' }}{{ $ft['legal_name'] }} — {{ $ft['tagline'] }}</title>
    <meta name="description" content="{{ $description ?? 'Fixed-price home and office removals, packing and storage across London, the South East and the UK. Get an instant quote online.' }}">
    <meta name="theme-color" content="#0d1733">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-dvh flex-col">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] focus:rounded-full focus:bg-go-400 focus:px-4 focus:py-2 focus:font-semibold">Skip to content</a>

    @include('partials.site-header')

    <main id="main" class="flex-1">
        {{ $slot }}
    </main>

    @include('partials.site-footer')

    {{-- Mobile action bar: the three things visitors want, always one tap away. --}}
    <nav class="fixed inset-x-3 bottom-3 z-40 grid grid-cols-3 gap-1 rounded-2xl bg-ink-950/95 p-1.5 shadow-2xl ring-1 ring-white/10 backdrop-blur md:hidden" aria-label="Quick contact">
        <a href="tel:{{ preg_replace('/\s+/', '', $ft['phone']) }}" class="flex flex-col items-center gap-0.5 rounded-xl py-2 text-[11px] font-semibold text-white/80 hover:bg-white/5">
            <x-icon name="phone" class="size-5" /> Call
        </a>
        <a href="https://wa.me/{{ $ft['whatsapp'] }}" class="flex flex-col items-center gap-0.5 rounded-xl py-2 text-[11px] font-semibold text-white/80 hover:bg-white/5">
            <x-icon name="message-circle" class="size-5" /> WhatsApp
        </a>
        <a href="{{ route('quote') }}" class="flex flex-col items-center gap-0.5 rounded-xl bg-go-400 py-2 text-[11px] font-bold text-ink-950">
            <x-icon name="zap" class="size-5" /> Get quote
        </a>
    </nav>
</body>
</html>
