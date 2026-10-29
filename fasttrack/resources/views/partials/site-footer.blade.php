@php($ft = config('fasttrack'))
<footer class="relative overflow-hidden bg-ink-950 pb-28 text-white/70 md:pb-0">
    <div class="pointer-events-none absolute -top-40 right-0 size-[520px] rounded-full bg-go-400/10 blur-3xl"></div>

    {{-- Closing CTA --}}
    <div class="container-page relative">
        <div class="flex flex-col items-start justify-between gap-8 border-b border-white/10 py-16 lg:flex-row lg:items-center">
            <div>
                <h2 class="max-w-xl text-3xl font-bold text-white sm:text-4xl">Ready when you are. <span class="text-go-400">Get your fixed price today.</span></h2>
                <p class="mt-3 max-w-lg text-white/60">Two minutes online, a reply {{ $ft['response_time'] }}, and a price that will not change on moving day.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('quote') }}" class="btn-go">Get a free quote <x-icon name="arrow-right" class="size-4" /></a>
                <a href="https://wa.me/{{ $ft['whatsapp'] }}" class="btn border border-white/15 text-white hover:bg-white/5"><x-icon name="message-circle" class="size-4" /> WhatsApp us</a>
            </div>
        </div>

        <div class="grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1.2fr]">
            <div>
                <x-logo inverse />
                <p class="mt-4 max-w-xs text-sm leading-relaxed">{{ $ft['tagline'] }} Fixed-price removals, packing and storage across {{ implode(', ', array_slice($ft['areas'], 0, 4)) }} and beyond.</p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white">Services</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    @foreach (array_slice($ft['services'], 0, 6, true) as $slug => $service)
                        <li><a href="{{ route('services.show', $slug) }}" class="hover:text-go-400">{{ $service['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white">Company</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-go-400">About us</a></li>
                    <li><a href="{{ route('pricing') }}" class="hover:text-go-400">Pricing</a></li>
                    <li><a href="{{ route('quote') }}" class="hover:text-go-400">Get a quote</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-go-400">Contact</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-go-400">Staff login</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white">Talk to us</h3>
                <ul class="mt-4 space-y-3 text-sm">
                    <li><a href="tel:{{ preg_replace('/\s+/', '', $ft['phone']) }}" class="flex items-center gap-2 hover:text-go-400"><x-icon name="phone" class="size-4 text-go-400" /> {{ $ft['phone'] }}</a></li>
                    <li><a href="mailto:{{ $ft['email'] }}" class="flex items-center gap-2 hover:text-go-400"><x-icon name="mail" class="size-4 text-go-400" /> {{ $ft['email'] }}</a></li>
                    <li class="flex items-start gap-2"><x-icon name="map-pin" class="mt-0.5 size-4 shrink-0 text-go-400" /> {{ $ft['address'] }}</li>
                    <li class="flex items-start gap-2"><x-icon name="clock" class="mt-0.5 size-4 shrink-0 text-go-400" /> {{ $ft['hours'] }}</li>
                </ul>
            </div>
        </div>

        <div class="flex flex-col justify-between gap-2 border-t border-white/10 py-6 text-xs text-white/45 sm:flex-row">
            <p>© {{ date('Y') }} {{ $ft['legal_name'] }}. All rights reserved.</p>
            <p>Website &amp; CRM by Eaglescroft</p>
        </div>
    </div>
</footer>
