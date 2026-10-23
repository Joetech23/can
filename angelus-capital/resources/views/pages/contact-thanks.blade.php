<x-layouts.app title="Thank You" description="Your enquiry has been received." bare noindex :conversion="session()->has('lead_name')">
    @php($company = config('acpl.company'))

    <section class="on-dark grain relative isolate flex min-h-[100svh] items-center overflow-hidden bg-navy-950 py-24 text-white">
        <div class="grid-lines absolute inset-0 -z-10"></div>
        <div class="absolute top-1/3 left-1/2 -z-10 size-[40rem] -translate-x-1/2 rounded-full bg-gold-500/15 blur-[140px]"></div>
        <canvas data-ribbons="7" class="absolute inset-0 -z-10 h-full w-full"></canvas>

        <div class="container-x mx-auto max-w-2xl text-center">
            <a href="{{ route('home') }}" class="inline-block" aria-label="{{ $company['name'] }}"><x-logo on-dark /></a>

            <div class="mx-auto mt-14 grid size-20 place-items-center rounded-full bg-gradient-to-br from-gold-300 to-ember text-navy-950 shadow-[0_20px_50px_-10px_rgba(239,125,16,0.6)]" data-reveal="zoom">
                <x-icon name="check" class="size-10" stroke="2.5" />
            </div>

            <h1 class="mt-10 font-display text-4xl leading-tight sm:text-5xl" data-reveal>
                Thank you{{ session('lead_name') ? ', '.session('lead_name') : '' }}.
            </h1>
            <p class="mt-6 text-lg leading-relaxed text-white/70" data-reveal>
                Your enquiry has been received and passed to the right team. A member of our team will review it and contact you to arrange an initial, confidential conversation.
            </p>

            <div class="mt-12 grid grid-cols-1 gap-4 text-left sm:grid-cols-2" data-reveal>
                <a href="tel:{{ $company['phone_href'] }}" class="card-dark flex items-center gap-4 p-5 transition hover:border-gold-400/40">
                    <x-icon name="phone" class="size-6 text-gold-400" />
                    <span><span class="block text-xs tracking-[0.2em] text-white/50 uppercase">Prefer to talk now?</span><span class="font-semibold">{{ $company['phone'] }}</span></span>
                </a>
                <a href="mailto:{{ $company['email'] }}" class="card-dark flex items-center gap-4 p-5 transition hover:border-gold-400/40">
                    <x-icon name="mail" class="size-6 text-gold-400" />
                    <span class="min-w-0"><span class="block text-xs tracking-[0.2em] text-white/50 uppercase">Email us</span><span class="block truncate font-semibold">{{ $company['email'] }}</span></span>
                </a>
            </div>

            <div class="mt-12 flex flex-wrap justify-center gap-4" data-reveal>
                <a href="{{ route('insights') }}" class="btn-outline">Read our insights</a>
                <a href="{{ route('home') }}" class="btn-gold">Explore our website <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
            </div>
        </div>
    </section>
</x-layouts.app>
