@php($ft = config('fasttrack'))
<x-layouts.site title="Moving guides" description="Practical moving advice from the FastTrack crew: checklists, packing tips, costs and office moves.">
    <x-page-hero eyebrow="Moving guides" title="Advice from the crew." lead="Practical, no-nonsense guides from people who move homes and offices every day." :crumbs="['Moving guides' => null]" />

    <section class="py-16 lg:py-24">
        <div class="container-page grid gap-5 md:grid-cols-2">
            @foreach ($ft['guides'] as $slug => $guide)
                <div x-reveal="{{ ($loop->index % 2) * 80 }}">@include('partials.guide-card', ['slug' => $slug, 'guide' => $guide])</div>
            @endforeach
        </div>
    </section>

    <x-cta-band />
</x-layouts.site>
