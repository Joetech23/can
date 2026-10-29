@php($ft = config('fasttrack'))
@php($tel = preg_replace('/\s+/', '', $ft['phone']))
<footer class="bg-ink-950 pb-20 text-white/60 md:pb-0">
    {{-- Closing CTA --}}
    <div class="border-t-4 border-go-500">
        <div class="container-page flex flex-col items-start justify-between gap-8 py-14 lg:flex-row lg:items-center">
            <div>
                <p class="eyebrow text-go-400">Ready when you are</p>
                <h2 class="mt-3 max-w-xl text-3xl text-white sm:text-4xl">See your price in two minutes.</h2>
                <p class="mt-3 max-w-lg">An instant estimate online, a fixed quote {{ $ft['response_time'] }}, and live tracking on moving day.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('quote') }}" class="btn-go">Get an instant quote <x-icon name="arrow-right" class="size-4" /></a>
                <a href="tel:{{ $tel }}" class="btn-line"><x-icon name="phone" class="size-4" /> {{ $ft['phone'] }}</a>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="container-page grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-[1.5fr_1fr_1fr_1fr_1.3fr]">
            <div>
                <x-logo inverse />
                <p class="mt-5 max-w-xs text-sm leading-relaxed">Removals, storage and pallet delivery with fixed prices, careful crews and live tracking.</p>
                @if (array_filter($ft['socials']))
                    <div class="mt-5 flex gap-2">
                        @foreach (['facebook' => 'facebook', 'instagram' => 'instagram', 'tiktok' => 'music'] as $network => $icon)
                            @if ($ft['socials'][$network])
                                <a href="{{ $ft['socials'][$network] }}" target="_blank" rel="noopener" class="grid size-10 place-items-center rounded-md border border-white/15 text-white hover:border-go-500 hover:text-go-400" aria-label="{{ ucfirst($network) }}"><x-icon :name="$icon" class="size-4" /></a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
            <div>
                <h3 class="label-caps text-white">Services</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    @foreach ($ft['services'] as $slug => $service)
                        <li><a href="{{ route('services.show', $slug) }}" class="hover:text-go-400">{{ $service['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="label-caps text-white">Areas</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    @foreach (array_slice($ft['areas'], 0, 6, true) as $slug => $area)
                        <li><a href="{{ route('areas.show', $slug) }}" class="hover:text-go-400">{{ $area['name'] }}</a></li>
                    @endforeach
                    <li><a href="{{ route('areas') }}" class="font-semibold text-white hover:text-go-400">All areas →</a></li>
                </ul>
            </div>
            <div>
                <h3 class="label-caps text-white">Company</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    @foreach (['about' => 'About us', 'pricing' => 'Pricing', 'reviews' => 'Reviews', 'guides' => 'Moving guides', 'faq' => 'FAQ', 'track' => 'Track my move', 'contact' => 'Contact'] as $route => $label)
                        <li><a href="{{ route($route) }}" class="hover:text-go-400">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="label-caps text-white">Talk to us</h3>
                <ul class="mt-4 space-y-3 text-sm">
                    <li><a href="tel:{{ $tel }}" class="flex items-center gap-2 hover:text-go-400"><x-icon name="phone" class="size-4 text-go-500" /> {{ $ft['phone'] }}</a></li>
                    <li><a href="https://wa.me/{{ $ft['whatsapp'] }}" class="flex items-center gap-2 hover:text-go-400"><x-icon name="message-circle" class="size-4 text-go-500" /> WhatsApp us</a></li>
                    <li><a href="mailto:{{ $ft['email'] }}" class="flex items-center gap-2 hover:text-go-400"><x-icon name="mail" class="size-4 text-go-500" /> {{ $ft['email'] }}</a></li>
                    <li class="flex items-start gap-2"><x-icon name="clock" class="mt-0.5 size-4 shrink-0 text-go-500" /> {{ $ft['hours'] }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="container-page flex flex-col gap-3 py-6 text-xs text-white/45 md:flex-row md:items-center md:justify-between">
            <p>© {{ date('Y') }} {{ $ft['legal_name'] }}@if ($ft['company_number']) · Company no. {{ $ft['company_number'] }}@endif · {{ $ft['address'] }}</p>
            <nav class="flex flex-wrap gap-x-5 gap-y-2" aria-label="Legal">
                <a href="{{ route('legal.privacy') }}" class="hover:text-white">Privacy policy</a>
                <a href="{{ route('legal.terms') }}" class="hover:text-white">Terms &amp; conditions</a>
                <a href="{{ route('legal.cookies') }}" class="hover:text-white">Cookie policy</a>
                <a href="{{ route('login') }}" class="hover:text-white">Staff login</a>
            </nav>
        </div>
    </div>
</footer>
