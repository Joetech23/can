<a href="{{ route('guides.show', $slug) }}" class="group flex flex-col overflow-hidden rounded-lg border border-ink-200 bg-white transition hover:border-ink-950 hover:shadow-xl hover:shadow-ink-950/5">
    <div class="relative flex h-36 items-end overflow-hidden bg-ink-950 p-5">
        <x-speed-lines class="absolute -right-16 top-0 h-full text-white/[0.06] transition duration-500 group-hover:-translate-x-4" />
        <span class="relative grid size-11 place-items-center rounded-md bg-go-600 text-white"><x-icon :name="$guide['icon']" /></span>
    </div>
    <div class="flex flex-1 flex-col p-6">
        <p class="label-caps text-ink-500">{{ $guide['minutes'] }} min read</p>
        <h3 class="mt-2 text-lg leading-snug text-ink-950">{{ $guide['title'] }}</h3>
        <p class="mt-2 flex-1 text-[15px] text-ink-600">{{ $guide['summary'] }}</p>
        <span class="mt-5 flex items-center gap-1 font-condensed text-sm font-bold tracking-wider text-go-600 uppercase">Read guide <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" /></span>
    </div>
</a>
