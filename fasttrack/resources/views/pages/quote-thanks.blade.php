@php($ft = config('fasttrack'))
<x-layouts.site title="Quote requested">
    <section class="relative overflow-hidden bg-ink-950 text-white">
        <x-speed-lines class="pointer-events-none absolute -right-24 top-0 h-full text-white/[0.04]" />
        <div class="container-page relative py-16 lg:py-24">
            <span class="grid size-16 place-items-center rounded-full bg-go-600"><x-icon name="check" class="size-8" /></span>
            <p class="eyebrow mt-8 text-go-400">Reference {{ $quote->reference }}</p>
            <h1 class="mt-3 max-w-2xl text-4xl sm:text-5xl">You're on the fast track.</h1>
            <p class="mt-4 max-w-xl text-lg font-light text-white/70">Thanks, {{ Str::before($quote->name, ' ') }}. We've emailed your reference and will be in touch {{ $ft['response_time'] }} to confirm your fixed price.</p>
        </div>
    </section>

    <section class="py-14 lg:py-20">
        <div class="container-page grid gap-8 lg:grid-cols-[1fr_1.3fr]">
            <div class="overflow-hidden rounded-lg border border-ink-200">
                <div class="bg-ink-950 px-6 py-3 font-condensed text-xs font-bold tracking-[0.2em] text-white uppercase">Your request</div>
                <dl class="divide-y divide-ink-200 text-[15px]">
                    @foreach (['Service' => $quote->serviceLabel(), 'Route' => $quote->from_postcode.' → '.$quote->to_postcode, 'Size' => $quote->sizeLabel(), 'Date' => $quote->move_date?->format('l j F Y') ?? 'To be confirmed'] as $label => $value)
                        <div class="flex justify-between gap-4 px-6 py-3.5"><dt class="text-ink-500">{{ $label }}</dt><dd class="text-right font-semibold text-ink-950">{{ $value }}</dd></div>
                    @endforeach
                </dl>
                @if ($quote->estimate_low)
                    <div class="flex items-center justify-between bg-go-100 px-6 py-5">
                        <span class="font-condensed text-sm font-bold tracking-[0.2em] text-go-700 uppercase">Instant estimate</span>
                        <span class="text-2xl font-bold text-go-700">£{{ number_format($quote->estimate_low) }} – £{{ number_format($quote->estimate_high) }}</span>
                    </div>
                @endif
            </div>
            <div>
                <h2 class="text-2xl text-ink-950">What happens next</h2>
                <ol class="mt-6 space-y-5">
                    @foreach ([['We review your request', 'A coordinator checks your route, date and anything in your notes.'], ['Quick survey', 'A short video call or chat to confirm what is moving.'], ['Fixed quote to accept online', 'Sent by email. Accept it and pay a small deposit to secure your date.'], ['Track your move', 'Use your reference and postcode on the Track my move page.']] as [$t, $b])
                        <li class="flex gap-4">
                            <span class="grid size-10 shrink-0 place-items-center rounded-md bg-ink-950 font-condensed text-lg font-bold text-white">0{{ $loop->iteration }}</span>
                            <span><span class="block font-semibold text-ink-950">{{ $t }}</span><span class="mt-0.5 block text-ink-600">{{ $b }}</span></span>
                        </li>
                    @endforeach
                </ol>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="https://wa.me/{{ $ft['whatsapp'] }}?text={{ urlencode('Hi FastTrack, my quote reference is '.$quote->reference) }}" class="btn-go"><x-icon name="message-circle" class="size-4" /> Speed things up on WhatsApp</a>
                    <a href="{{ route('track') }}" class="btn-ghost"><x-icon name="navigation" class="size-4" /> Track my move</a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.site>
