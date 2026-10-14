@props(['title' => 'Let’s build what’s next, together.', 'lead' => 'Whether you are raising capital, structuring a project or seeking quality investment opportunities, our team is ready to partner with you.'])

<section class="bg-ivory py-24 sm:py-32">
    <div class="container-x">
        <div class="on-dark grain relative isolate overflow-hidden rounded-[2.5rem] bg-navy-900 px-8 py-16 sm:px-16 sm:py-20" data-reveal="zoom" data-tilt-area>
            <div class="absolute -top-24 -left-24 -z-10 size-96 rounded-full bg-gold-500/25 blur-[100px]"></div>
            <div class="absolute -right-10 -bottom-32 -z-10 size-96 rounded-full bg-navy-500/50 blur-[100px]"></div>
            <canvas data-ribbons="5" class="absolute inset-0 -z-10 h-full w-full opacity-60"></canvas>

            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-[1fr_auto]">
                <div class="max-w-2xl">
                    <span class="eyebrow">Partner with ACPL</span>
                    <h2 class="mt-6 font-display text-4xl leading-tight text-white text-balance sm:text-5xl">{{ $title }}</h2>
                    <p class="mt-6 text-lg leading-relaxed text-white/65">{{ $lead }}</p>
                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="{{ route('contact') }}" class="btn-gold">Start a conversation <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
                        <a href="tel:{{ config('acpl.company.phone_href') }}" class="btn-outline"><x-icon name="phone" class="size-4" /> {{ config('acpl.company.phone') }}</a>
                    </div>
                </div>
                <img src="{{ asset('images/acpl-mark.webp') }}" alt="" width="317" height="288" data-tilt="18" class="mx-auto hidden w-64 drop-shadow-[0_30px_60px_rgba(239,125,16,0.35)] lg:block">
            </div>
        </div>
    </div>
</section>
