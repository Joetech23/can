<x-layouts.admin title="Quotes">
    <div class="flex flex-col justify-between gap-4 xl:flex-row xl:items-end">
        <div>
            <h1 class="text-3xl font-bold">Quotes</h1>
            <p class="mt-1 text-ink-500 dark:text-ink-400">Every quote request from the website, from first contact to completed move.</p>
        </div>
        <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">
            <form class="flex flex-1">
                @if ($status) <input type="hidden" name="status" value="{{ $status }}"> @endif
                <label class="flex flex-1 items-center gap-2 rounded-full border border-ink-200 bg-white px-4 py-2.5 sm:w-72 dark:border-white/10 dark:bg-ink-900">
                    <x-icon name="search" class="size-4 text-ink-400" />
                    <input name="q" value="{{ $search }}" placeholder="Name, phone, ref or postcode" class="w-full bg-transparent text-sm focus:outline-none" aria-label="Search quotes">
                </label>
            </form>
            <a href="{{ route('admin.quotes.export', array_filter(['status' => $status, 'q' => $search])) }}" class="btn-ghost py-2.5 whitespace-nowrap"><x-icon name="file-text" class="size-4" /> Export CSV</a>
            <a href="{{ route('admin.quotes.create') }}" class="btn-go py-2.5 whitespace-nowrap"><x-icon name="plus" class="size-4" /> New quote</a>
        </div>
    </div>

    <div class="mt-6 flex gap-2 overflow-x-auto pb-1">
        <a href="{{ route('admin.quotes.index', array_filter(['q' => $search])) }}" @class(['shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition', 'bg-ink-950 text-white dark:bg-white dark:text-ink-950' => ! $status, 'bg-white text-ink-600 ring-1 ring-ink-200 hover:ring-ink-300 dark:bg-ink-900 dark:text-ink-300 dark:ring-white/10' => $status])>All <span class="ml-1 opacity-60">{{ $counts->sum() }}</span></a>
        @foreach (\App\Models\Quote::STATUSES as $key => $s)
            <a href="{{ route('admin.quotes.index', array_filter(['status' => $key, 'q' => $search])) }}" @class(['shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition', 'bg-ink-950 text-white dark:bg-white dark:text-ink-950' => $status === $key, 'bg-white text-ink-600 ring-1 ring-ink-200 hover:ring-ink-300 dark:bg-ink-900 dark:text-ink-300 dark:ring-white/10' => $status !== $key])>{{ $s['label'] }} <span class="ml-1 opacity-60">{{ $counts[$key] ?? 0 }}</span></a>
        @endforeach
    </div>

    <div class="card mt-6 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px] text-left text-sm">
                <thead class="border-b border-ink-100 text-xs font-semibold tracking-wider text-ink-500 uppercase dark:border-white/5 dark:text-ink-400">
                    <tr>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Move</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Price</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100 dark:divide-white/5">
                    @forelse ($quotes as $q)
                        <tr class="group relative transition hover:bg-ink-50 dark:hover:bg-white/[0.03]">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.quotes.show', $q) }}" class="flex items-center gap-3 after:absolute after:inset-0">
                                    <span class="grid size-10 shrink-0 place-items-center rounded-full bg-ink-950 text-xs font-bold text-go-400 dark:bg-white/10">{{ $q->initials() }}</span>
                                    <span>
                                        <span class="block font-semibold text-ink-950 dark:text-white">{{ $q->name }}</span>
                                        <span class="block text-xs text-ink-500 dark:text-ink-400">{{ $q->reference }} · {{ $q->created_at->diffForHumans() }}@if ($q->source !== 'website') · {{ \App\Models\Quote::SOURCES[$q->source] ?? $q->source }}@endif</span>
                                    </span>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block font-medium">{{ $q->from_postcode }} → {{ $q->to_postcode }}</span>
                                <span class="block text-xs text-ink-500 dark:text-ink-400">{{ $q->serviceLabel() }} · {{ $q->sizeLabel() }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $q->move_date?->format('D j M') ?? 'TBC' }}@if ($q->flexible_date) <span class="ml-1 text-xs text-ink-400">flex</span> @endif</td>
                            <td class="px-6 py-4"><x-status :status="$q->status" /></td>
                            <td class="px-6 py-4 text-right font-semibold whitespace-nowrap">{{ $q->estimate ? '£'.number_format($q->estimate, 2) : '—' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-16 text-center text-ink-500">No quotes match. Try a different filter.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6">{{ $quotes->links() }}</div>
</x-layouts.admin>
