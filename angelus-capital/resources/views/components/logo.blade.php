@props(['tone' => 'light', 'compact' => false])

<span {{ $attributes->merge(['class' => 'group inline-flex items-center gap-3']) }}>
    <img src="{{ asset('images/acpl-mark.webp') }}" alt="" width="317" height="288" class="h-10 w-auto transition-transform duration-700 ease-out-expo group-hover:rotate-[-6deg] group-hover:scale-105 {{ $compact ? '' : 'sm:h-11' }}">
    <span class="h-9 w-px {{ $tone === 'light' ? 'bg-gold-400/50' : 'bg-gold-500/60' }}"></span>
    <span class="flex flex-col leading-none">
        <span class="font-display text-[1.45rem] tracking-wide {{ $tone === 'light' ? 'text-white' : 'text-navy-900' }}">Angelus</span>
        <span class="mt-1 text-[0.58rem] font-semibold tracking-[0.24em] uppercase {{ $tone === 'light' ? 'text-white/70' : 'text-navy-700' }}">Capital Partners Limited</span>
    </span>
    <span class="sr-only">{{ config('acpl.company.name') }}</span>
</span>
