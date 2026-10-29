@props(['num' => null, 'eyebrow', 'title', 'lead' => null, 'center' => false, 'dark' => false])
<div {{ $attributes->class(['max-w-2xl', 'mx-auto text-center' => $center]) }}>
    <p @class(['eyebrow', 'text-go-400' => $dark])>@if ($num){{ $num }} · @endif{{ $eyebrow }}</p>
    <h2 @class(['mt-3 text-3xl leading-tight sm:text-[2.6rem]', 'text-white' => $dark, 'text-ink-950' => ! $dark])>{{ $title }}</h2>
    @if ($lead)
        <p @class(['mt-4 text-lg leading-relaxed font-light', 'text-white/65' => $dark, 'text-ink-600' => ! $dark])>{{ $lead }}</p>
    @endif
</div>
