<figure class="flex flex-col rounded-lg border border-ink-200 bg-white p-7">
    <div class="flex items-center justify-between">
        <div class="flex gap-0.5 text-go-500" aria-label="{{ $review['rating'] }} out of 5 stars">@for ($s = 0; $s < $review['rating']; $s++) <x-icon name="star" class="size-4 fill-current" /> @endfor</div>
        <x-icon name="quote" class="size-7 text-ink-200" />
    </div>
    <blockquote class="mt-5 flex-1 leading-relaxed text-ink-700">“{{ $review['body'] }}”</blockquote>
    <figcaption class="mt-6 flex items-center gap-3 border-t border-ink-200 pt-5">
        <span class="grid size-10 place-items-center rounded-md bg-ink-950 font-bold text-white">{{ strtoupper(substr($review['name'], 0, 1)) }}</span>
        <span>
            <span class="block text-sm font-semibold text-ink-950">{{ $review['name'] }}</span>
            <span class="block text-xs text-ink-500">{{ $review['area'] }} · {{ $review['service'] }}</span>
        </span>
    </figcaption>
</figure>
