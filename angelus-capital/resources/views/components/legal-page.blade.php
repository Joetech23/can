@props(['title', 'updated'])

<x-layouts.app :title="$title" :description="$title.' — '.config('acpl.company.name')">
    <section class="on-dark relative isolate overflow-hidden bg-navy-950 pt-36 pb-16 text-white sm:pt-44">
        <div class="grid-lines absolute inset-0 -z-10"></div>
        <div class="container-x mx-auto max-w-3xl">
            <span class="eyebrow">Legal</span>
            <h1 class="mt-6 font-display text-5xl sm:text-6xl">{{ $title }}</h1>
            <p class="mt-6 text-sm text-white/55">Last updated {{ $updated }}</p>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20">
        <div class="container-x mx-auto max-w-3xl space-y-6 text-lg leading-relaxed text-ink/80 [&_h2]:pt-6 [&_h2]:font-display [&_h2]:text-3xl [&_h2]:text-navy-900 [&_li]:ml-6 [&_li]:list-disc [&_a]:text-gold-600 [&_a]:underline">
            {{ $slot }}
        </div>
    </section>
</x-layouts.app>
