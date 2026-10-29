@props(['title' => 'Dashboard', 'crumb' => null])
@php
    $nav = [
        ['admin.dashboard', 'Dashboard', 'layout-dashboard', null],
        ['admin.quotes.*', 'Quotes', 'file-text', $newQuotes ?: null],
        ['admin.jobs', 'Jobs & schedule', 'truck', null],
        ['admin.customers', 'Customers', 'users', null],
        ['admin.enquiries.*', 'Enquiries', 'inbox', $unreadEnquiries ?: null],
    ];
    $routeFor = fn ($pattern) => route(str_replace('.*', '.index', $pattern));
@endphp
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>{{ $title }} · FastTrack CRM</title>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <script>
        try {
            const t = localStorage.getItem('ft-theme');
            if (t === 'dark' || (!t && matchMedia('(prefers-color-scheme: dark)').matches)) document.documentElement.classList.add('dark');
        } catch (e) {}
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ink-50 text-ink-900 dark:bg-ink-950 dark:text-white" x-data="{ nav: false }">
    {{-- Sidebar --}}
    <aside class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col border-r border-ink-100 bg-white transition-transform duration-300 lg:translate-x-0 dark:border-white/5 dark:bg-ink-950"
           :class="nav && 'translate-x-0'">
        <div class="flex h-20 items-center justify-between px-6">
            <a href="{{ route('admin.dashboard') }}"><span class="dark:hidden"><x-logo /></span><span class="hidden dark:block"><x-logo inverse /></span></a>
            <button class="grid size-9 place-items-center rounded-full hover:bg-ink-50 lg:hidden dark:hover:bg-white/5" @click="nav = false" aria-label="Close menu"><x-icon name="x" /></button>
        </div>
        <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4" aria-label="CRM">
            <p class="px-4 pb-2 text-[11px] font-bold tracking-[0.18em] text-ink-500 uppercase dark:text-ink-400">Workspace</p>
            @foreach ($nav as [$pattern, $label, $icon, $badge])
                @php($active = request()->routeIs($pattern))
                <a href="{{ $routeFor($pattern) }}" @if ($active) aria-current="page" @endif
                   @class([
                       'group relative flex items-center gap-3 rounded-xl px-4 py-3 text-[15px] font-medium transition',
                       'bg-ink-950 text-white dark:bg-white/[0.06]' => $active,
                       'text-ink-600 hover:bg-ink-50 hover:text-ink-950 dark:text-ink-300 dark:hover:bg-white/[0.04] dark:hover:text-white' => ! $active,
                   ])>
                    @if ($active) <span class="absolute inset-y-2 left-0 w-1 rounded-r-full bg-go-400"></span> @endif
                    <x-icon :name="$icon" @class(['size-5', 'text-go-400' => $active]) />
                    <span class="flex-1">{{ $label }}</span>
                    @if ($badge) <span class="rounded-full bg-go-400 px-2 py-0.5 text-xs font-bold text-ink-950">{{ $badge }}</span> @endif
                </a>
            @endforeach

            <p class="px-4 pt-6 pb-2 text-[11px] font-bold tracking-[0.18em] text-ink-500 uppercase dark:text-ink-400">Website</p>
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 rounded-xl px-4 py-3 text-[15px] font-medium text-ink-600 hover:bg-ink-50 hover:text-ink-950 dark:text-ink-300 dark:hover:bg-white/[0.04] dark:hover:text-white"><x-icon name="globe" /> View live site</a>
            <a href="{{ route('quote') }}" target="_blank" class="flex items-center gap-3 rounded-xl px-4 py-3 text-[15px] font-medium text-ink-600 hover:bg-ink-50 hover:text-ink-950 dark:text-ink-300 dark:hover:bg-white/[0.04] dark:hover:text-white"><x-icon name="file-text" /> Public quote form</a>
        </nav>
        <div class="m-3 rounded-2xl bg-ink-950 p-4 text-white ring-1 ring-white/5 dark:bg-white/[0.04]">
            <div class="flex items-center gap-3">
                <span class="grid size-10 place-items-center rounded-full bg-go-400 font-bold text-ink-950">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                <span class="min-w-0 flex-1">
                    <span class="block truncate text-sm font-semibold">{{ auth()->user()->name }}</span>
                    <span class="block truncate text-xs text-white/50">{{ auth()->user()->email }}</span>
                </span>
                <form method="post" action="{{ route('logout') }}">@csrf
                    <button class="grid size-9 place-items-center rounded-full text-white/60 hover:bg-white/10 hover:text-white" aria-label="Log out" title="Log out"><x-icon name="log-out" class="size-4" /></button>
                </form>
            </div>
        </div>
    </aside>
    <div class="fixed inset-0 z-40 bg-ink-950/50 backdrop-blur-sm lg:hidden" x-show="nav" x-transition.opacity x-cloak @click="nav = false"></div>

    <div class="lg:pl-72">
        {{-- Top bar --}}
        <header class="sticky top-0 z-30 flex h-20 items-center gap-3 border-b border-ink-100 bg-white/85 px-4 backdrop-blur-lg sm:px-8 dark:border-white/5 dark:bg-ink-950/85">
            <button class="grid size-10 place-items-center rounded-full hover:bg-ink-50 lg:hidden dark:hover:bg-white/5" @click="nav = true" aria-label="Open menu"><x-icon name="menu" /></button>
            <form action="{{ route('admin.quotes.index') }}" class="hidden max-w-md flex-1 md:block">
                <label class="flex items-center gap-3 rounded-full border border-ink-100 bg-ink-50 px-4 py-2.5 focus-within:border-go-500 focus-within:ring-4 focus-within:ring-go-200 dark:border-white/10 dark:bg-white/[0.03] dark:focus-within:ring-go-900">
                    <x-icon name="search" class="size-5 text-ink-400" />
                    <input name="q" value="{{ request('q') }}" placeholder="Search quotes, customers, postcodes…" aria-label="Search quotes" class="w-full bg-transparent text-sm placeholder:text-ink-400 focus:outline-none">
                </label>
            </form>
            <div class="ml-auto flex items-center gap-2 sm:gap-3">
                <div class="hidden items-center gap-3 rounded-full border border-ink-100 bg-ink-950 py-1.5 pr-1.5 pl-4 text-white sm:flex dark:border-white/10">
                    <span class="leading-tight">
                        <span class="block text-[10px] font-bold tracking-[0.16em] text-white/50 uppercase">Open pipeline</span>
                        <span class="block text-sm font-bold">£{{ number_format($pipeline, 0) }}</span>
                    </span>
                    <a href="{{ route('admin.quotes.index', ['status' => 'new']) }}" class="rounded-full bg-go-400 px-4 py-2 text-sm font-bold text-ink-950 hover:bg-go-300">Work leads</a>
                </div>
                <button type="button" @click="$store.theme.toggle()" class="grid size-11 place-items-center rounded-full text-ink-600 hover:bg-ink-50 dark:text-ink-300 dark:hover:bg-white/5" :aria-label="$store.theme.dark ? 'Switch to light mode' : 'Switch to dark mode'">
                    <x-icon name="sun" x-show="$store.theme.dark" x-cloak />
                    <x-icon name="moon" x-show="!$store.theme.dark" />
                </button>
                <a href="{{ route('admin.enquiries.index') }}" class="relative grid size-11 place-items-center rounded-full text-ink-600 hover:bg-ink-50 dark:text-ink-300 dark:hover:bg-white/5" aria-label="Enquiries">
                    <x-icon name="bell" />
                    @if ($newQuotes + $unreadEnquiries)
                        <span class="absolute top-1.5 right-1.5 grid min-w-5 place-items-center rounded-full bg-red-500 px-1 text-[11px] font-bold text-white ring-2 ring-white dark:ring-ink-950">{{ $newQuotes + $unreadEnquiries }}</span>
                    @endif
                </a>
            </div>
        </header>

        <main class="px-4 py-8 sm:px-8">
            <nav class="mb-6 flex items-center gap-2 text-sm text-ink-500 dark:text-ink-400" aria-label="Breadcrumb">
                <x-icon name="layout-dashboard" class="size-4" />
                <x-icon name="chevron-right" class="size-3.5" />
                @if ($crumb)
                    <a href="{{ $crumb[1] }}" class="hover:text-ink-950 dark:hover:text-white">{{ $crumb[0] }}</a>
                    <x-icon name="chevron-right" class="size-3.5" />
                @endif
                <span class="font-semibold text-ink-950 dark:text-white">{{ $title }}</span>
            </nav>

            @if (session('status'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl border border-go-300 bg-go-50 px-5 py-3 text-sm font-medium text-go-900 dark:border-go-400/30 dark:bg-go-400/10 dark:text-go-200" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition>
                    <x-icon name="check-circle" class="size-5" /> {{ session('status') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>
</body>
</html>
