@php($company = config('acpl.company'))

<footer class="relative overflow-hidden bg-navy-950 text-white">
    <div class="pointer-events-none absolute -top-40 left-1/2 h-80 w-[60rem] -translate-x-1/2 rounded-full bg-gold-500/10 blur-3xl"></div>

    <div class="container-x relative">
        <div class="grid grid-cols-1 gap-14 border-b border-white/10 py-20 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <x-logo />
                <p class="mt-8 max-w-sm leading-relaxed text-white/60">{{ $company['summary'] }}</p>
                <p class="mt-8 font-serif text-2xl text-gold-300 italic">{{ $company['tagline'] }}</p>

                <div class="mt-8 flex gap-3">
                    <a href="https://wa.me/{{ $company['whatsapp'] }}?text={{ rawurlencode($company['whatsapp_message']) }}" target="_blank" rel="noopener" class="grid size-11 place-items-center rounded-full border border-white/15 text-white/70 transition hover:border-gold-400 hover:text-gold-300" aria-label="Chat with us on WhatsApp"><x-icon name="whatsapp" class="size-5" /></a>
                    <a href="mailto:{{ $company['email'] }}" class="grid size-11 place-items-center rounded-full border border-white/15 text-white/70 transition hover:border-gold-400 hover:text-gold-300" aria-label="Email us"><x-icon name="mail" class="size-5" /></a>
                    @if ($company['linkedin'])
                        <a href="{{ $company['linkedin'] }}" target="_blank" rel="noopener" class="grid size-11 place-items-center rounded-full border border-white/15 text-white/70 transition hover:border-gold-400 hover:text-gold-300" aria-label="Angelus Capital Partners on LinkedIn"><x-icon name="linkedin" class="size-5" /></a>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 gap-10 sm:grid-cols-[1fr_1fr_1.6fr] lg:col-span-8">
                <div>
                    <h3 class="text-xs font-semibold tracking-[0.25em] text-gold-400 uppercase">Firm</h3>
                    <ul class="mt-6 space-y-3 text-sm">
                        <li><a href="{{ route('about') }}" class="text-white/65 transition hover:text-white">About ACPL</a></li>
                        <li><a href="{{ route('leadership') }}" class="text-white/65 transition hover:text-white">Leadership</a></li>
                        <li><a href="{{ route('sectors') }}" class="text-white/65 transition hover:text-white">Sectors & Transactions</a></li>
                        <li><a href="{{ route('insights') }}" class="text-white/65 transition hover:text-white">News & Insights</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white/65 transition hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-semibold tracking-[0.25em] text-gold-400 uppercase">Platforms</h3>
                    <ul class="mt-6 space-y-3 text-sm">
                        @foreach (config('acpl.platforms') as $platform)
                            <li><a href="{{ route('services') }}#{{ $platform['key'] }}" class="text-white/65 transition hover:text-white">{{ $platform['title'] }}</a></li>
                        @endforeach
                        <li><a href="{{ route('services') }}#einvoice" class="text-white/65 transition hover:text-white">E-Invoice Compliance</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-semibold tracking-[0.25em] text-gold-400 uppercase">Reach us</h3>
                    <ul class="mt-6 space-y-4 text-sm text-white/65">
                        <li class="flex gap-3">
                            <x-icon name="pin" class="mt-0.5 size-4 text-gold-400" />
                            <span><span class="block text-xs tracking-wider text-white/40 uppercase">Head office</span>{!! implode('<br>', array_map('e', $company['address'])) !!}</span>
                        </li>
                        @if ($company['branch_address'])
                            <li class="flex gap-3">
                                <x-icon name="pin" class="mt-0.5 size-4 text-gold-400" />
                                <span><span class="block text-xs tracking-wider text-white/40 uppercase">Branch office</span>{!! implode('<br>', array_map('e', (array) $company['branch_address'])) !!}</span>
                            </li>
                        @endif
                        <li><a href="tel:{{ $company['phone_href'] }}" class="flex gap-3 transition hover:text-white"><x-icon name="phone" class="mt-0.5 size-4 text-gold-400" />{{ $company['phone'] }}</a></li>
                        <li><a href="mailto:{{ $company['email'] }}" class="flex gap-3 break-words transition hover:text-white"><x-icon name="mail" class="mt-0.5 size-4 text-gold-400" />{{ $company['email'] }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 py-8 text-xs text-white/45 lg:flex-row lg:items-center lg:justify-between">
            <p>
                &copy; {{ now()->year }} {{ $company['name'] }}.@if ($company['rc_number']) {{ $company['rc_number'] }}.@endif All rights reserved.
            </p>
            <nav class="flex flex-wrap gap-x-6 gap-y-2" aria-label="Legal">
                <a href="{{ route('privacy') }}" class="transition hover:text-white">Privacy Policy</a>
                <a href="{{ route('disclaimer') }}" class="transition hover:text-white">Disclaimer</a>
                <span class="tracking-wide">{{ $company['strapline'] }}</span>
            </nav>
        </div>
    </div>
</footer>
