@php($company = config('acpl.company'))

{{-- Profile banner: the 2026 brand collateral, closing every page. --}}
<section class="relative isolate overflow-hidden bg-white pt-20 sm:pt-28" aria-label="{{ $company['name'] }} profile">
    <div class="brand-lines absolute inset-0 -z-10"></div>

    <div class="container-x">
        <div class="mx-auto flex max-w-4xl flex-col items-center gap-8 text-center sm:flex-row sm:items-stretch sm:gap-10 sm:text-left" data-reveal>
            <img src="{{ asset('images/acpl-logo.webp') }}" alt="" width="600" height="566" loading="lazy" class="w-32 self-center sm:w-44">
            <span class="hidden w-px bg-gold-500 sm:block"></span>
            <div class="flex flex-col justify-center">
                <p class="font-display text-5xl leading-none text-navy-900 sm:text-6xl">Angelus</p>
                <p class="mt-2 font-display text-2xl text-navy-900 sm:text-3xl">Capital Partners Limited</p>
                <p class="mt-4 text-lg font-semibold tracking-wide text-gold-600 sm:text-xl">{{ $company['tagline'] }}</p>
                <span class="mx-auto mt-4 flex w-56 items-center gap-2 sm:mx-0" aria-hidden="true">
                    <span class="h-px flex-1 bg-gold-500/70"></span><span class="size-1.5 rotate-45 bg-gold-500"></span><span class="h-px flex-1 bg-gold-500/70"></span>
                </span>
                <p class="mt-4 font-serif text-xl text-navy-800 italic">{{ $company['strapline'] }}</p>
            </div>
        </div>
    </div>

    <x-brand-wave class="mt-14 h-16 sm:mt-20 sm:h-24" />
    <div class="bg-navy-900 pb-14 text-white">
        <ul class="container-x grid grid-cols-1 gap-8 pt-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-0">
            @foreach (config('acpl.profile_banner') as $item)
                <li @class(['flex items-center gap-4 lg:justify-center lg:px-6', 'lg:border-l lg:border-gold-500/40' => ! $loop->first])>
                    <x-icon :name="$item['icon']" class="size-9 shrink-0 text-gold-400" stroke="1.4" />
                    <span class="leading-snug text-white/90">{{ $item['line'] }}<br>{{ $item['sub'] }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</section>
