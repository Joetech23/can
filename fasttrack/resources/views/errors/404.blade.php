<x-layouts.site title="Page not found">
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute -top-40 left-1/2 size-[640px] -translate-x-1/2 rounded-full bg-go-200/50 blur-3xl"></div>
        <div class="container-page relative flex flex-col items-center py-24 text-center">
            <span class="grid size-20 place-items-center rounded-3xl bg-ink-950 text-go-400"><x-icon name="route" class="size-10" /></span>
            <p class="mt-8 text-sm font-bold tracking-widest text-go-700 uppercase">Error 404</p>
            <h1 class="mt-3 max-w-2xl text-4xl font-extrabold text-ink-950 sm:text-5xl">Wrong turn. This page has moved on.</h1>
            <p class="mt-4 max-w-lg text-lg text-ink-600">The page you were looking for isn't here, but we can still get your move on track.</p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('quote') }}" class="btn-go">Get a free quote <x-icon name="arrow-right" class="size-4" /></a>
                <a href="{{ route('home') }}" class="btn-ghost">Back to home</a>
            </div>
        </div>
    </section>
</x-layouts.site>
