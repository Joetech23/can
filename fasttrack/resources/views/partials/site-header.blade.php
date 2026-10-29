@php($ft = config('fasttrack'))
<div class="hidden bg-ink-950 text-[13px] text-white/70 md:block">
    <div class="container-page flex h-10 items-center justify-between">
        <p class="flex items-center gap-2">
            <span class="size-2 rounded-full bg-go-400 animate-pulse-dot"></span>
            Booking now for this month · Quotes replied {{ $ft['response_time'] }}
        </p>
        <div class="flex items-center gap-6">
            <a href="mailto:{{ $ft['email'] }}" class="flex items-center gap-1.5 hover:text-white"><x-icon name="mail" class="size-4" /> {{ $ft['email'] }}</a>
            <a href="tel:{{ preg_replace('/\s+/', '', $ft['phone']) }}" class="flex items-center gap-1.5 hover:text-white"><x-icon name="phone" class="size-4" /> {{ $ft['phone'] }}</a>
        </div>
    </div>
</div>

<header x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = window.scrollY > 8"
        class="sticky top-0 z-50 border-b transition-colors duration-300"
        :class="scrolled ? 'border-ink-100 bg-white/90 backdrop-blur-lg' : 'border-transparent bg-white'">
    <div class="container-page flex h-[72px] items-center justify-between gap-6">
        <a href="{{ route('home') }}" aria-label="FastTrack home"><x-logo /></a>

        <nav class="hidden items-center gap-1 lg:flex" aria-label="Main">
            <div class="relative" x-data="{ menu: false }" @mouseenter="menu = true" @mouseleave="menu = false">
                <a href="{{ route('services') }}" @focus="menu = true" class="flex items-center gap-1 rounded-full px-4 py-2 text-[15px] font-medium text-ink-700 hover:bg-ink-50 hover:text-ink-950 {{ request()->routeIs('services*') ? 'text-ink-950' : '' }}">
                    Services <x-icon name="chevron-down" class="size-4 transition" ::class="menu && 'rotate-180'" />
                </a>
                <div x-show="menu" x-transition.origin.top x-cloak @click.outside="menu = false"
                     class="absolute top-full left-1/2 w-[560px] -translate-x-1/2 pt-3">
                    <div class="grid grid-cols-2 gap-1 rounded-3xl border border-ink-100 bg-white p-3 shadow-2xl shadow-ink-900/10">
                        @foreach ($ft['services'] as $slug => $service)
                            <a href="{{ route('services.show', $slug) }}" class="group flex gap-3 rounded-2xl p-3 hover:bg-ink-50">
                                <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-go-100 text-go-800 transition group-hover:bg-go-400 group-hover:text-ink-950">
                                    <x-icon :name="$service['icon']" />
                                </span>
                                <span>
                                    <span class="block text-sm font-semibold text-ink-950">{{ $service['name'] }}</span>
                                    <span class="line-clamp-1 text-[13px] text-ink-500">{{ $service['from'] }}</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @foreach (['pricing' => 'Pricing', 'about' => 'About', 'contact' => 'Contact'] as $route => $label)
                <a href="{{ route($route) }}" class="rounded-full px-4 py-2 text-[15px] font-medium hover:bg-ink-50 hover:text-ink-950 {{ request()->routeIs($route) ? 'text-ink-950' : 'text-ink-700' }}" @if (request()->routeIs($route)) aria-current="page" @endif>{{ $label }}</a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2">
            <a href="tel:{{ preg_replace('/\s+/', '', $ft['phone']) }}" class="hidden items-center gap-2 rounded-full px-3 py-2 text-sm font-semibold text-ink-800 hover:bg-ink-50 xl:flex">
                <x-icon name="phone" class="size-4" /> {{ $ft['phone'] }}
            </a>
            <a href="{{ route('quote') }}" class="btn-go hidden sm:inline-flex">Get a free quote <x-icon name="arrow-right" class="size-4" /></a>
            <button type="button" class="grid size-11 place-items-center rounded-full text-ink-900 hover:bg-ink-50 lg:hidden" @click="open = !open" :aria-expanded="open" aria-label="Menu">
                <x-icon name="menu" class="size-6" x-show="!open" />
                <x-icon name="x" class="size-6" x-show="open" x-cloak />
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-transition x-cloak class="border-t border-ink-100 bg-white lg:hidden">
        <nav class="container-page grid gap-1 py-4" aria-label="Mobile">
            <p class="px-3 pt-1 pb-2 text-xs font-bold tracking-widest text-ink-400 uppercase">Services</p>
            <div class="grid grid-cols-2 gap-1">
                @foreach ($ft['services'] as $slug => $service)
                    <a href="{{ route('services.show', $slug) }}" class="flex items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-medium text-ink-800 hover:bg-ink-50">
                        <x-icon :name="$service['icon']" class="size-4 text-go-700" /> {{ $service['name'] }}
                    </a>
                @endforeach
            </div>
            <hr class="my-2 border-ink-100">
            @foreach (['pricing' => 'Pricing', 'about' => 'About us', 'contact' => 'Contact'] as $route => $label)
                <a href="{{ route($route) }}" class="rounded-xl px-3 py-3 font-semibold text-ink-900 hover:bg-ink-50">{{ $label }}</a>
            @endforeach
            <a href="{{ route('quote') }}" class="btn-go mt-2">Get a free quote <x-icon name="arrow-right" class="size-4" /></a>
        </nav>
    </div>
</header>
