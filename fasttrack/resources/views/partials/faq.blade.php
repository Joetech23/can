<div class="divide-y divide-ink-200 border-y border-ink-200" x-data="{ open: 0 }">
    @foreach ($faqs as $i => $faq)
        <div>
            <h3>
                <button type="button" class="flex w-full items-center justify-between gap-4 py-5 text-left text-lg font-semibold text-ink-950" @click="open = open === {{ $i }} ? null : {{ $i }}" :aria-expanded="open === {{ $i }}">
                    {{ $faq['q'] }}
                    <span class="grid size-8 shrink-0 place-items-center rounded-md border border-ink-200 transition" :class="open === {{ $i }} && 'rotate-45 border-go-600 bg-go-600 text-white'"><x-icon name="plus" class="size-4" /></span>
                </button>
            </h3>
            <div x-show="open === {{ $i }}" x-collapse.duration.200ms @if ($i !== 0) x-cloak @endif class="pr-12 pb-5 leading-relaxed text-ink-600">{{ $faq['a'] }}</div>
        </div>
    @endforeach
</div>
