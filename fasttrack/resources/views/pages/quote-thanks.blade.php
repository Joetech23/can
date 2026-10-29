@php($ft = config('fasttrack'))
<x-layouts.site title="Quote requested">
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute -top-40 left-1/2 size-[640px] -translate-x-1/2 rounded-full bg-go-200/60 blur-3xl"></div>
        <div class="container-page relative flex flex-col items-center py-24 text-center">
            <span class="grid size-20 place-items-center rounded-full bg-go-400 text-ink-950 shadow-[0_0_0_12px_rgb(185_236_47/0.25)]"><x-icon name="check" class="size-10" /></span>
            <p class="mt-8 text-sm font-bold tracking-widest text-go-700 uppercase">Reference {{ $reference }}</p>
            <h1 class="mt-3 max-w-2xl text-4xl font-extrabold text-ink-950 sm:text-5xl">You're on the fast track.</h1>
            <p class="mt-4 max-w-xl text-lg text-ink-600">Thanks. We've got your details and someone from the team will be in touch {{ $ft['response_time'] }} to confirm your fixed price.</p>
            <div class="mt-10 grid w-full max-w-3xl gap-4 text-left sm:grid-cols-3">
                @foreach ([['clock', 'We review your move', 'A coordinator checks your route and date.'], ['phone', 'Quick survey', 'A short video call or chat to confirm volume.'], ['file-text', 'Fixed price', 'Sent in writing. Book with a small deposit.']] as [$icon, $t, $b])
                    <div class="card p-5">
                        <x-icon :name="$icon" class="size-6 text-go-700" />
                        <p class="mt-4 font-semibold text-ink-950">{{ $t }}</p>
                        <p class="mt-1 text-sm text-ink-600">{{ $b }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-10 flex flex-wrap justify-center gap-3">
                <a href="https://wa.me/{{ $ft['whatsapp'] }}?text={{ urlencode('Hi FastTrack, my quote reference is '.$reference) }}" class="btn-ink"><x-icon name="message-circle" class="size-4" /> Speed things up on WhatsApp</a>
                <a href="{{ route('home') }}" class="btn-ghost">Back to home</a>
            </div>
        </div>
    </section>
</x-layouts.site>
