@props(['title' => null, 'description' => null, 'bare' => false, 'noindex' => false, 'conversion' => false])

@php
    $company = config('acpl.company');
    $pageTitle = $title ? $title.' — '.$company['short_name'] : $company['name'].' — '.$company['tagline'];
    $pageDescription = $description ?? $company['summary'];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#071834">

        <title>{{ $pageTitle }}</title>
        <meta name="description" content="{{ $pageDescription }}">

        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ $company['name'] }}">
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $pageDescription }}">
        <meta property="og:image" content="{{ asset('images/acpl-mark.png') }}">
        <link rel="canonical" href="{{ url()->current() }}">
        @if ($noindex)
            <meta name="robots" content="noindex, follow">
        @endif

        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'FinancialService',
                'name' => $company['name'],
                'alternateName' => $company['abbr'],
                'slogan' => $company['tagline'],
                'description' => $company['summary'],
                'url' => config('app.url'),
                'email' => $company['email'],
                'telephone' => $company['phone'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $company['address'][0],
                    'addressLocality' => 'Lagos',
                    'addressCountry' => 'NG',
                ],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>

        <x-tracking :conversion="$conversion" />
    </head>
    <body class="min-h-screen">
        <a href="#main" class="sr-only z-[100] rounded-full bg-gold-400 px-5 py-3 font-semibold text-navy-950 focus:not-sr-only focus:fixed focus:top-4 focus:left-4">Skip to content</a>

        @unless ($bare)
            <x-site-header />
        @endunless

        <main id="main">
            {{ $slot }}
        </main>

        @unless ($bare)
            <x-site-footer />
        @endunless
    </body>
</html>
