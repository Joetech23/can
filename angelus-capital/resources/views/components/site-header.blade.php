<header data-header class="fixed inset-x-0 top-0 z-50 border-b border-transparent bg-white/85 transition-all duration-500">
    <div data-header-inner class="container-x flex items-center justify-between gap-6 py-5 transition-all duration-500">
        <a href="{{ route('home') }}" aria-label="{{ config('acpl.company.name') }} — home">
            <x-logo />
        </a>

        <nav class="hidden items-center gap-1 lg:flex" aria-label="Primary">
            @foreach (config('acpl.navigation') as $item)
                <a href="{{ route($item['route']) }}"
                   @class([
                       'relative rounded-full px-4 py-2 text-sm font-medium transition-colors duration-300',
                       'text-gold-700' => request()->routeIs($item['route'], $item['route'].'.*'),
                       'text-navy-900/75 hover:text-navy-900' => ! request()->routeIs($item['route'], $item['route'].'.*'),
                   ])
                   @if (request()->routeIs($item['route'], $item['route'].'.*')) aria-current="page" @endif>
                    {{ $item['label'] }}
                    @if (request()->routeIs($item['route'], $item['route'].'.*'))
                        <span class="absolute inset-x-4 -bottom-0.5 h-px bg-gradient-to-r from-transparent via-gold-500 to-transparent"></span>
                    @endif
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-3">
            <a href="{{ route('contact') }}" class="btn-gold hidden !px-5 !py-2.5 sm:inline-flex">
                Partner with us
                <x-icon name="arrow-up-right" class="size-4" stroke="2" />
            </a>

            <button type="button" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" class="grid size-11 place-items-center rounded-full border border-navy-900/15 text-navy-900 lg:hidden">
                <span class="sr-only">Toggle navigation</span>
                <x-icon name="menu" data-nav-icon="open" class="size-5" stroke="2" />
                <x-icon name="close" data-nav-icon="close" class="hidden size-5" stroke="2" />
            </button>
        </div>
    </div>

    <div id="mobile-nav" data-nav-panel class="pointer-events-none fixed inset-x-0 top-0 -z-10 -translate-y-4 bg-white/97 px-5 pt-28 pb-10 opacity-0 backdrop-blur-xl transition-all duration-500 ease-out-expo lg:hidden">
        <nav class="flex flex-col" aria-label="Mobile">
            <a href="{{ route('home') }}" class="border-b border-navy-900/10 py-4 font-display text-2xl text-navy-900">Home</a>
            @foreach (config('acpl.navigation') as $item)
                <a href="{{ route($item['route']) }}" class="flex items-center justify-between border-b border-navy-900/10 py-4 font-display text-2xl {{ request()->routeIs($item['route'], $item['route'].'.*') ? 'text-gold-700' : 'text-navy-900' }}">
                    {{ $item['label'] }}
                    <x-icon name="arrow-right" class="size-5 text-gold-600" />
                </a>
            @endforeach
            <a href="{{ route('contact') }}" class="btn-gold mt-8">Partner with us</a>
        </nav>
    </div>
</header>
