@props(['leader', 'eager' => false])

<div {{ $attributes->merge(['class' => 'relative rounded-[1.75rem] bg-gradient-to-br from-gold-300 via-gold-500 to-ember p-[3px] shadow-[0_30px_60px_-25px_rgba(7,24,52,0.55)]']) }}>
    <div class="relative overflow-hidden rounded-[calc(1.75rem-3px)] bg-navy-900">
        <img src="{{ asset($leader['photo']) }}" alt="Portrait of {{ $leader['name'] }}, {{ $leader['role'] }}" width="450" height="563" @if (! $eager) loading="lazy" @endif class="aspect-[4/5] w-full object-cover object-top transition duration-700 ease-out-expo group-hover:scale-[1.04]">
        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-navy-950/70 to-transparent"></div>
    </div>
</div>
