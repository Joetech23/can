@php($ft = config('fasttrack'))
@php($tel = preg_replace('/\s+/', '', $ft['phone']))
<header x-data="{ open: false }" class="sticky top-0 z-50">
    {{-- Utility bar --}}
    <div class="hidden border-b border-white/10 bg-ink-950 text-[13px] text-white/60 md:block">
        <div class="container-page flex h-9 items-center justify-between">
            <p class="flex items-center gap-2"><span class="size-1.5 rounded-full bg-go-500 animate-pulse-dot"></span> Instant online quotes · Replies {{ $ft['response_time'] }}</p>
            <div class="flex items-center gap-5">
                <a href="{{ route('track') }}" class="flex items-center gap-1.5 hover:text-white"><x-icon name="navigation" class="size-3.5" /> Track my move</a>
                <a href="mailto:{{ $ft['email'] }}" class="flex items-center gap-1.5 hover:text-white"><x-icon name="mail" class="size-3.5" /> {{ $ft['email'] }}</a>
            </div>
        </div>
    </div>

    {{-- Main bar --}}
    <div class="border-b-4 border-go-500 bg-ink-950">
        <div class="container-page flex h-[72px] items-center justify-between gap-6">
            <a href="{{ route('home') }}" aria-label="FastTrack Team Logistics home"><x-logo inverse /></a>

            <nav class="hidden items-center lg:flex" aria-label="Main">
                @foreach ([
                    ['services', 'Services', 'services*', $ft['services'], 'services.show'],
                    ['areas', 'Areas', 'areas*', $ft['areas'], 'areas.show'],
                ] as [$route, $label, $pattern, $items, $itemRoute])
                    <div class="relative" x-data="{ menu: false }" @mouseenter="menu = true" @mouseleave="menu = false" @keydown.escape="menu = false">
                        <a href="{{ route($route) }}" @focus="menu = true" @class(['flex items-center gap-1 px-3.5 py-2 font-condensed text-[15px] font-semibold tracking-[0.08em] uppercase transition', 'text-white' => request()->routeIs($pattern), 'text-white/70 hover:text-white' => ! request()->routeIs($pattern)])>
                            {{ $label }} <x-icon name="chevron-down" class="size-4 transition" ::class="menu && 'rotate-180'" />
                        </a>
                        <div x-show="menu" x-transition.origin.top x-cloak class="absolute top-full left-0 pt-[18px]">
                            <div @class(['grid gap-1 rounded-b-lg border border-t-0 border-ink-200 bg-white p-3 shadow-2xl', 'w-[540px] grid-cols-2' => $route === 'services', 'w-[420px] grid-cols-2' => $route === 'areas'])>
                                @foreach ($items as $slug => $item)
                                    <a href="{{ route($itemRoute, $slug) }}" class="group flex items-center gap-3 rounded-md p-2.5 hover:bg-ink-50">
                                        @isset($item['icon'])
                                            <span class="grid size-10 shrink-0 place-items-center rounded-md bg-ink-950 text-white transition group-hover:bg-go-600"><x-icon :name="$item['icon']" /></span>
                                            <span>
                                                <span class="block text-sm font-semibold text-ink-950">{{ $item['name'] }}</span>
                                                <span class="block text-[13px] text-ink-500">{{ $item['from'] }}</span>
                                            </span>
                                        @else
                                            <x-icon name="map-pin" class="size-4 text-go-600" />
                                            <span class="text-sm font-medium text-ink-800 group-hover:text-ink-950">Removals {{ $item['name'] }}</span>
                                        @endisset
                                    </a>
                                @endforeach
                                <a href="{{ route($route) }}" class="col-span-2 mt-1 flex items-center justify-between rounded-md bg-ink-50 px-3 py-2.5 font-condensed text-sm font-bold tracking-wider text-ink-950 uppercase hover:bg-go-100">
                                    All {{ strtolower($label) }} <x-icon name="arrow-right" class="size-4" />
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach (['pricing' => 'Pricing', 'reviews' => 'Reviews', 'about' => 'About', 'contact' => 'Contact'] as $route => $label)
                    <a href="{{ route($route) }}" @if (request()->routeIs($route)) aria-current="page" @endif @class(['px-3.5 py-2 font-condensed text-[15px] font-semibold tracking-[0.08em] uppercase transition', 'text-white' => request()->routeIs($route), 'text-white/70 hover:text-white' => ! request()->routeIs($route)])>{{ $label }}</a>
                @endforeach
            </nav>

            <div class="flex items-center gap-2">
                <a href="tel:{{ $tel }}" class="hidden items-center gap-2 px-3 py-2 font-semibold text-white xl:flex">
                    <span class="grid size-9 place-items-center rounded-full border border-white/20"><x-icon name="phone" class="size-4" /></span> {{ $ft['phone'] }}
                </a>
                <a href="{{ route('quote') }}" class="btn-go hidden sm:inline-flex">Instant quote <x-icon name="arrow-right" class="size-4" /></a>
                <button type="button" class="grid size-11 place-items-center text-white lg:hidden" @click="open = !open" :aria-expanded="open" aria-label="Menu">
                    <x-icon name="menu" class="size-6" x-show="!open" />
                    <x-icon name="x" class="size-6" x-show="open" x-cloak />
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-transition x-cloak class="max-h-[calc(100dvh-76px)] overflow-y-auto border-b border-ink-200 bg-white shadow-xl lg:hidden">
        <nav class="container-page grid gap-1 py-5" aria-label="Mobile">
            <p class="label-caps px-2 pb-2 text-ink-500">Services</p>
            <div class="grid grid-cols-2 gap-1">
                @foreach ($ft['services'] as $slug => $service)
                    <a href="{{ route('services.show', $slug) }}" class="flex items-center gap-2 rounded-md px-2 py-2.5 text-sm font-medium text-ink-900 hover:bg-ink-50">
                        <x-icon :name="$service['icon']" class="size-4 text-go-600" /> {{ $service['name'] }}
                    </a>
                @endforeach
            </div>
            <hr class="my-3 border-ink-200">
            @foreach (['areas' => 'Areas we cover', 'pricing' => 'Pricing', 'reviews' => 'Reviews', 'about' => 'About us', 'guides' => 'Moving guides', 'faq' => 'FAQ', 'contact' => 'Contact', 'track' => 'Track my move'] as $route => $label)
                <a href="{{ route($route) }}" class="flex items-center justify-between rounded-md px-2 py-3 font-condensed text-lg font-semibold tracking-wide text-ink-950 uppercase hover:bg-ink-50">{{ $label }} <x-icon name="chevron-right" class="size-4 text-ink-400" /></a>
            @endforeach
            <a href="{{ route('quote') }}" class="btn-go mt-3">Get an instant quote <x-icon name="arrow-right" class="size-4" /></a>
        </nav>
    </div>
</header>
