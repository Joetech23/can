@php($company = config('acpl.company'))

<footer class="relative overflow-hidden bg-navy-950 text-white">
    <div class="pointer-events-none absolute -top-40 left-1/2 h-80 w-[60rem] -translate-x-1/2 rounded-full bg-gold-500/10 blur-3xl"></div>

    <div class="container-x relative">
        <div class="grid grid-cols-1 gap-14 border-b border-white/10 py-20 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <x-logo />
                <p class="mt-8 max-w-sm leading-relaxed text-white/60">{{ $company['summary'] }}</p>
                <p class="mt-8 font-serif text-2xl text-gold-300 italic">{{ $company['tagline'] }}</p>
            </div>

            <div class="grid grid-cols-1 gap-10 sm:grid-cols-[1fr_1fr_1.5fr] lg:col-span-7">
                <div>
                    <h3 class="text-xs font-semibold tracking-[0.25em] text-gold-400 uppercase">Firm</h3>
                    <ul class="mt-6 space-y-3 text-sm">
                        <li><a href="{{ route('about') }}" class="text-white/65 transition hover:text-white">About ACPL</a></li>
                        <li><a href="{{ route('leadership') }}" class="text-white/65 transition hover:text-white">Leadership</a></li>
                        <li><a href="{{ route('transactions') }}" class="text-white/65 transition hover:text-white">Transactions</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white/65 transition hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-semibold tracking-[0.25em] text-gold-400 uppercase">Platforms</h3>
                    <ul class="mt-6 space-y-3 text-sm">
                        @foreach (config('acpl.platforms') as $platform)
                            <li><a href="{{ route('services') }}#{{ $platform['key'] }}" class="text-white/65 transition hover:text-white">{{ $platform['title'] }}</a></li>
                        @endforeach
                        <li><a href="{{ route('sectors') }}" class="text-white/65 transition hover:text-white">Sectors of focus</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-semibold tracking-[0.25em] text-gold-400 uppercase">Reach us</h3>
                    <ul class="mt-6 space-y-4 text-sm text-white/65">
                        <li class="flex gap-3">
                            <x-icon name="pin" class="mt-0.5 size-4 text-gold-400" />
                            <span>{!! implode('<br>', array_map('e', $company['address'])) !!}</span>
                        </li>
                        <li><a href="tel:{{ $company['phone_href'] }}" class="flex gap-3 transition hover:text-white"><x-icon name="phone" class="mt-0.5 size-4 text-gold-400" />{{ $company['phone'] }}</a></li>
                        <li><a href="mailto:{{ $company['email'] }}" class="flex gap-3 break-words transition hover:text-white"><x-icon name="mail" class="mt-0.5 size-4 text-gold-400" />{{ $company['email'] }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 py-8 text-xs text-white/45 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ now()->year }} {{ $company['name'] }}. All rights reserved.</p>
            <p class="tracking-wide">{{ $company['strapline'] }}</p>
        </div>
    </div>
</footer>
