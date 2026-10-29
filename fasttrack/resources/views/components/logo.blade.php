@props(['inverse' => false, 'compact' => false])
{{-- FT mark redrawn as vector from the FastTrack Team Logistics proposal artwork. --}}
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-3']) }}>
    <x-logo-mark class="h-8 w-auto shrink-0 {{ $inverse ? 'text-white' : 'text-ink-950' }}" />
    @unless ($compact)
        <span class="flex flex-col leading-none">
            <span class="text-[1.3rem] font-bold tracking-[0.02em] {{ $inverse ? 'text-white' : 'text-ink-950' }}">FASTTRACK</span>
            <span class="mt-1 font-condensed text-[0.62rem] font-normal tracking-[0.48em] {{ $inverse ? 'text-white/55' : 'text-ink-500' }}">TEAM LOGISTICS</span>
        </span>
    @endunless
</span>
