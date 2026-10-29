<x-layouts.admin title="Jobs & schedule">
    <h1 class="text-3xl font-bold">Jobs & schedule</h1>
    <p class="mt-1 text-ink-500 dark:text-ink-400">Booked moves, grouped by day.</p>

    <div class="mt-8 grid gap-6 xl:grid-cols-[1.6fr_1fr]">
        <div class="space-y-6">
            @forelse ($upcoming as $date => $jobs)
                @php($day = \Illuminate\Support\Carbon::parse($date))
                <section class="card overflow-hidden">
                    <header class="flex items-center gap-4 border-b border-ink-100 px-6 py-4 dark:border-white/5">
                        <span class="flex w-14 flex-col items-center rounded-xl {{ $day->isToday() ? 'bg-go-400 text-ink-950' : 'bg-ink-950 text-white dark:bg-white/10' }} py-1.5">
                            <span class="text-[10px] font-bold uppercase">{{ $day->format('D') }}</span>
                            <span class="font-display text-xl leading-none font-bold">{{ $day->format('j') }}</span>
                        </span>
                        <div>
                            <h2 class="font-bold">{{ $day->isToday() ? 'Today' : ($day->isTomorrow() ? 'Tomorrow' : $day->format('l j F')) }}</h2>
                            <p class="text-sm text-ink-500 dark:text-ink-400">{{ $jobs->count() }} {{ Str::plural('move', $jobs->count()) }} · £{{ number_format($jobs->sum('estimate'), 0) }}</p>
                        </div>
                    </header>
                    <ul class="divide-y divide-ink-100 dark:divide-white/5">
                        @foreach ($jobs as $job)
                            <li>
                                <a href="{{ route('admin.quotes.show', $job) }}" class="grid gap-3 px-6 py-4 transition hover:bg-ink-50 sm:grid-cols-[1fr_auto_auto] sm:items-center dark:hover:bg-white/[0.03]">
                                    <span>
                                        <span class="block font-semibold">{{ $job->name }} <span class="ml-1 text-xs font-normal text-ink-400">{{ $job->reference }}</span></span>
                                        <span class="block text-sm text-ink-500 dark:text-ink-400">{{ $job->serviceLabel() }} · {{ $job->sizeLabel() }}</span>
                                    </span>
                                    <span class="flex items-center gap-2 text-sm font-medium"><x-icon name="route" class="size-4 text-go-600" /> {{ $job->from_postcode }} → {{ $job->to_postcode }}</span>
                                    <span class="font-semibold sm:text-right">£{{ number_format($job->estimate, 0) }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @empty
                <div class="card flex flex-col items-center px-6 py-16 text-center">
                    <x-icon name="calendar" class="size-10 text-ink-300" />
                    <p class="mt-4 font-semibold">No upcoming moves booked</p>
                    <p class="mt-1 text-sm text-ink-500">Mark a quote as <em>Booked</em> with a move date and it will appear here.</p>
                </div>
            @endforelse
        </div>

        <aside class="space-y-6">
            @if ($unscheduled->isNotEmpty())
                <section class="card p-6">
                    <h2 class="flex items-center gap-2 font-bold"><span class="size-2 rounded-full bg-amber-400"></span> Booked, no date yet</h2>
                    <ul class="mt-4 space-y-2">
                        @foreach ($unscheduled as $job)
                            <li><a href="{{ route('admin.quotes.show', $job) }}" class="flex justify-between rounded-xl px-3 py-2 text-sm hover:bg-ink-50 dark:hover:bg-white/5"><span class="font-medium">{{ $job->name }}</span><span class="text-ink-500">{{ $job->reference }}</span></a></li>
                        @endforeach
                    </ul>
                </section>
            @endif
            <section class="card p-6">
                <h2 class="font-bold">Recently completed</h2>
                <ul class="mt-4 space-y-1">
                    @forelse ($recent as $job)
                        <li><a href="{{ route('admin.quotes.show', $job) }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 hover:bg-ink-50 dark:hover:bg-white/5">
                            <span class="grid size-8 place-items-center rounded-full bg-emerald-50 text-emerald-600 dark:bg-emerald-400/10 dark:text-emerald-300"><x-icon name="check" class="size-4" /></span>
                            <span class="flex-1 text-sm"><span class="block font-medium">{{ $job->name }}</span><span class="block text-xs text-ink-500">{{ $job->updated_at->diffForHumans() }}</span></span>
                            <span class="text-sm font-semibold">£{{ number_format($job->estimate, 0) }}</span>
                        </a></li>
                    @empty
                        <li class="text-sm text-ink-500">Nothing completed yet.</li>
                    @endforelse
                </ul>
            </section>
        </aside>
    </div>
</x-layouts.admin>
