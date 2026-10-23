@props(['onDark' => false, 'compact' => false])

{{-- Brand lockup: mark, slim gold rule, then the company name. --}}
<span {{ $attributes->merge(['class' => 'group inline-flex items-center gap-3']) }}>
    <img src="{{ asset($onDark ? 'images/acpl-logo-dark.webp' : 'images/acpl-logo.webp') }}" alt="" width="600" height="566" class="h-11 w-auto transition-transform duration-700 ease-out-expo group-hover:rotate-[-6deg] group-hover:scale-105 {{ $compact ? '' : 'sm:h-12' }}">
    <span class="h-10 w-px {{ $onDark ? 'bg-gold-400/60' : 'bg-gold-500' }}"></span>
    <span class="flex flex-col leading-none">
        <span class="font-display text-[1.5rem] tracking-wide {{ $onDark ? 'text-white' : 'text-navy-900' }}">Angelus</span>
        <span class="mt-1 text-[0.58rem] font-semibold tracking-[0.22em] uppercase {{ $onDark ? 'text-white/70' : 'text-navy-900/80' }}">Capital Partners Limited</span>
    </span>
    <span class="sr-only">{{ config('acpl.company.name') }}</span>
</span>
