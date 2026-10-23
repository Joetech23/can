@props(['title', 'updated'])

<x-layouts.app :title="$title" :description="$title.' — '.config('acpl.company.name')">
    <section class="relative isolate overflow-hidden bg-white pt-36 pb-20 sm:pt-44">
        <div class="brand-lines absolute inset-0 -z-10"></div>
        <div class="container-x mx-auto max-w-3xl">
            <span class="eyebrow">Legal</span>
            <h1 class="mt-6 font-display text-5xl text-navy-900 sm:text-6xl">{{ $title }}</h1>
            <p class="mt-6 text-sm text-mist">Last updated {{ $updated }}</p>
        </div>
        <x-brand-wave class="absolute inset-x-0 bottom-0 h-8 opacity-90 sm:h-12" />
    </section>

    <section class="bg-white py-16 sm:py-20">
        <div class="container-x mx-auto max-w-3xl space-y-6 text-lg leading-relaxed text-ink/80 [&_h2]:pt-6 [&_h2]:font-display [&_h2]:text-3xl [&_h2]:text-navy-900 [&_li]:ml-6 [&_li]:list-disc [&_a]:text-gold-600 [&_a]:underline">
            {{ $slot }}
        </div>
    </section>
</x-layouts.app>
