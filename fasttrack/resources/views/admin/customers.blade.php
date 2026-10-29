<x-layouts.admin title="Customers">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <h1 class="text-3xl font-bold">Customers</h1>
            <p class="mt-1 text-ink-500 dark:text-ink-400">Everyone who has asked for a quote, with their booked spend.</p>
        </div>
        <form>
            <label class="flex items-center gap-2 rounded-full border border-ink-200 bg-white px-4 py-2.5 sm:w-72 dark:border-white/10 dark:bg-ink-900">
                <x-icon name="search" class="size-4 text-ink-400" />
                <input name="q" value="{{ $search }}" placeholder="Search name, email or phone" aria-label="Search customers" class="w-full bg-transparent text-sm focus:outline-none">
            </label>
        </form>
    </div>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @forelse ($customers as $c)
            <a href="{{ route('admin.quotes.index', ['q' => $c->contact]) }}" class="card group p-6 transition hover:-translate-y-0.5 hover:shadow-lg">
                <div class="flex items-center gap-3">
                    <span class="grid size-12 place-items-center rounded-full bg-ink-950 font-bold text-go-400 dark:bg-white/10">{{ collect(explode(' ', $c->name))->take(2)->map(fn ($p) => mb_substr($p, 0, 1))->implode('') }}</span>
                    <div class="min-w-0">
                        <p class="truncate font-semibold">{{ $c->name }}</p>
                        <p class="truncate text-sm text-ink-500 dark:text-ink-400">{{ $c->email ?? 'No email' }}</p>
                    </div>
                </div>
                <dl class="mt-5 grid grid-cols-3 gap-2 rounded-2xl bg-ink-50 p-3 text-center dark:bg-white/[0.03]">
                    <div><dt class="text-[11px] text-ink-500 dark:text-ink-400">Quotes</dt><dd class="font-bold">{{ $c->quotes }}</dd></div>
                    <div><dt class="text-[11px] text-ink-500 dark:text-ink-400">Spend</dt><dd class="font-bold">£{{ number_format($c->spend, 0) }}</dd></div>
                    <div><dt class="text-[11px] text-ink-500 dark:text-ink-400">Last seen</dt><dd class="font-bold">{{ \Illuminate\Support\Carbon::parse($c->last_seen)->format('j M') }}</dd></div>
                </dl>
                <p class="mt-4 flex items-center gap-2 text-sm text-ink-600 dark:text-ink-300"><x-icon name="phone" class="size-4" /> {{ $c->phone }}</p>
            </a>
        @empty
            <p class="col-span-full py-16 text-center text-ink-500">No customers yet.</p>
        @endforelse
    </div>
    <div class="mt-6">{{ $customers->links() }}</div>
</x-layouts.admin>
