<div class="divide-y divide-ink-100 rounded-3xl border border-ink-100 bg-white" x-data="{ open: 0 }">
    @foreach ($faqs as $i => $faq)
        <div>
            <h3>
                <button type="button" class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left font-semibold text-ink-950" @click="open = open === {{ $i }} ? null : {{ $i }}" :aria-expanded="open === {{ $i }}">
                    {{ $faq['q'] }}
                    <span class="grid size-8 shrink-0 place-items-center rounded-full bg-ink-50 transition" :class="open === {{ $i }} && 'rotate-45 bg-go-400'"><x-icon name="plus" class="size-4" /></span>
                </button>
            </h3>
            <div x-show="open === {{ $i }}" x-collapse.duration.200ms @if ($i !== 0) x-cloak @endif class="px-6 pb-5 leading-relaxed text-ink-600">{{ $faq['a'] }}</div>
        </div>
    @endforeach
</div>
