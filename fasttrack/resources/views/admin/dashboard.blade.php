<x-layouts.admin title="Dashboard">
    @if ($needsReply)
        <div class="mb-6 flex items-start gap-4 rounded-3xl border border-go-400/50 bg-go-50 p-5 dark:border-go-400/30 dark:bg-go-400/[0.06]" x-data="{ show: true }" x-show="show" x-transition>
            <span class="grid size-9 shrink-0 place-items-center rounded-full bg-go-400 text-ink-950"><x-icon name="zap" class="size-5" /></span>
            <div class="flex-1">
                <p class="font-semibold text-ink-950 dark:text-white">{{ $needsReply }} new {{ Str::plural('quote request', $needsReply) }} waiting for a reply</p>
                <p class="mt-1 text-sm text-ink-600 dark:text-ink-300">The first removals company to respond usually wins the job. Aim to reply {{ config('fasttrack.response_time') }}.</p>
                <a href="{{ route('admin.quotes.index', ['status' => 'new']) }}" class="mt-3 inline-flex items-center gap-1 text-sm font-semibold text-go-800 hover:underline dark:text-go-300">Reply now <x-icon name="arrow-right" class="size-4" /></a>
            </div>
            <button class="grid size-8 place-items-center rounded-full text-ink-500 hover:bg-go-100 dark:hover:bg-white/5" @click="show = false" aria-label="Dismiss"><x-icon name="x" class="size-4" /></button>
        </div>
    @endif

    <div class="grid gap-6 xl:grid-cols-[1.6fr_1fr]">
        {{-- Greeting / pipeline card --}}
        <section class="relative overflow-hidden rounded-3xl bg-ink-950 p-7 text-white ring-1 ring-white/5 sm:p-9">
            <div class="pointer-events-none absolute -top-24 right-0 size-80 rounded-full bg-go-400/25 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-32 left-1/3 size-72 rounded-full bg-sky-500/10 blur-3xl"></div>
            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-white/60">{{ $today->format('l, j M Y') }}</p>
                    <h1 class="mt-2 text-3xl font-bold sm:text-4xl">{{ $greeting }}, {{ Str::before(auth()->user()->name, ' ') }}!</h1>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="grid size-11 place-items-center rounded-full ring-1 ring-white/15 hover:bg-white/5" aria-label="Refresh"><x-icon name="refresh-cw" class="size-5" /></a>
            </div>
            <p class="relative mt-10 text-xs font-bold tracking-[0.2em] text-white/50 uppercase">Open pipeline value</p>
            <p class="relative mt-2 font-display text-5xl font-extrabold tracking-tight sm:text-6xl">£{{ number_format($pipelineValue, 2) }}</p>
            <div class="relative mt-8 grid grid-cols-3 divide-x divide-white/10 rounded-2xl bg-white/[0.05] ring-1 ring-white/10">
                @foreach ([['Booked', '£'.number_format($bookedValue, 0)], ['Completed this month', '£'.number_format($completedValue, 0)], ['Awaiting reply', $needsReply]] as [$label, $value])
                    <div class="px-4 py-4 sm:px-5">
                        <p class="text-[11px] leading-tight text-white/55 sm:text-xs">{{ $label }}</p>
                        <p class="mt-1 text-lg font-bold">{{ $value }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Quick actions --}}
        <section class="card p-7">
            <h2 class="text-xl font-bold">Quick actions</h2>
            <div class="mt-5 grid grid-cols-2 gap-3">
                @foreach ([
                    [route('admin.quotes.index', ['status' => 'new']), 'Work new leads', 'zap', 'bg-go-400 text-ink-950'],
                    [route('admin.jobs'), 'Upcoming moves', 'truck', 'bg-sky-500 text-white'],
                    [route('admin.enquiries.index'), 'Enquiries', 'inbox', 'bg-violet-500 text-white'],
                    [route('admin.quotes.create'), 'Log a phone lead', 'phone', 'bg-emerald-500 text-white'],
                ] as [$href, $label, $icon, $tone])
                    <a href="{{ $href }}" class="group rounded-2xl border border-ink-100 p-4 transition hover:-translate-y-0.5 hover:border-ink-200 hover:shadow-lg dark:border-white/10 dark:hover:border-white/20">
                        <span class="grid size-11 place-items-center rounded-xl {{ $tone }} shadow-sm"><x-icon :name="$icon" /></span>
                        <span class="mt-4 block text-[15px] leading-tight font-semibold">{{ $label }}</span>
                    </a>
                @endforeach
            </div>
        </section>
    </div>

    {{-- Stats --}}
    <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="card p-6">
            <div class="flex items-center justify-between"><p class="text-sm font-medium text-ink-500 dark:text-ink-400">New leads this month</p><span class="grid size-10 place-items-center rounded-xl bg-sky-50 text-sky-600 dark:bg-sky-400/10 dark:text-sky-300"><x-icon name="file-text" class="size-5" /></span></div>
            <p class="mt-3 font-display text-4xl font-bold">{{ $newLeads }}</p>
            @if (! is_null($leadsChange))
                <p class="mt-1 text-sm font-medium {{ $leadsChange >= 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">{{ $leadsChange >= 0 ? '+' : '' }}{{ $leadsChange }}% from last month</p>
            @endif
        </div>
        <div class="card p-6">
            <div class="flex items-center justify-between"><p class="text-sm font-medium text-ink-500 dark:text-ink-400">Win rate (90 days)</p><span class="grid size-10 place-items-center rounded-xl bg-go-100 text-go-700 dark:bg-go-400/10 dark:text-go-300"><x-icon name="check-circle" class="size-5" /></span></div>
            <p class="mt-3 font-display text-4xl font-bold">{{ $conversion }}%</p>
            <div class="mt-4 h-2 rounded-full bg-ink-100 dark:bg-white/10"><div class="h-2 rounded-full bg-go-500" style="width: {{ min(100, $conversion) }}%"></div></div>
        </div>
        <div class="card p-6">
            <p class="text-sm font-medium text-ink-500 dark:text-ink-400">Pipeline by stage</p>
            @php($total = max(1, $statusCounts->sum()))
            <div class="mt-4 flex h-3 overflow-hidden rounded-full bg-ink-100 dark:bg-white/10">
                @foreach (['new' => 'bg-sky-500', 'contacted' => 'bg-violet-500', 'surveyed' => 'bg-amber-400', 'quoted' => 'bg-orange-500', 'booked' => 'bg-go-500', 'completed' => 'bg-emerald-500', 'lost' => 'bg-ink-300 dark:bg-ink-600'] as $s => $bg)
                    @if ($statusCounts[$s] ?? 0) <span class="{{ $bg }}" style="width: {{ ($statusCounts[$s] / $total) * 100 }}%" title="{{ \App\Models\Quote::STATUSES[$s]['label'] }}: {{ $statusCounts[$s] }}"></span> @endif
                @endforeach
            </div>
            <dl class="mt-4 grid grid-cols-2 gap-x-3 gap-y-1.5 text-xs">
                @foreach (['new' => 'bg-sky-500', 'quoted' => 'bg-orange-500', 'booked' => 'bg-go-500', 'completed' => 'bg-emerald-500'] as $s => $bg)
                    <div class="flex items-center gap-1.5"><span class="size-2 rounded-full {{ $bg }}"></span><dt class="text-ink-500 dark:text-ink-400">{{ \App\Models\Quote::STATUSES[$s]['label'] }}</dt><dd class="ml-auto font-semibold">{{ $statusCounts[$s] ?? 0 }}</dd></div>
                @endforeach
            </dl>
        </div>
        <div class="card p-6">
            <p class="text-sm font-medium text-ink-500 dark:text-ink-400">Leads per week</p>
            @php($max = max(1, $weeks->max('count')))
            <div class="mt-4 flex h-24 items-end gap-1.5">
                @foreach ($weeks as $w)
                    <div class="group relative flex flex-1 flex-col items-center justify-end">
                        <span class="absolute -top-6 hidden rounded bg-ink-950 px-1.5 py-0.5 text-[10px] font-bold text-white group-hover:block dark:bg-white dark:text-ink-950">{{ $w['count'] }}</span>
                        <span @class(['w-full rounded-md transition', 'bg-go-500' => $loop->last, 'bg-ink-200 group-hover:bg-ink-300 dark:bg-white/15 dark:group-hover:bg-white/25' => ! $loop->last]) style="height: {{ max(6, $w['count'] / $max * 96) }}px"></span>
                    </div>
                @endforeach
            </div>
            <div class="mt-2 flex justify-between text-[10px] text-ink-400"><span>{{ $weeks->first()['label'] }}</span><span>This week</span></div>
        </div>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-[1.6fr_1fr]">
        {{-- Recent quotes --}}
        <section class="card overflow-hidden">
            <div class="flex items-center justify-between px-7 pt-7 pb-4">
                <h2 class="text-xl font-bold">Recent quote requests</h2>
                <a href="{{ route('admin.quotes.index') }}" class="text-sm font-semibold text-go-700 hover:underline dark:text-go-400">View all</a>
            </div>
            <ul class="divide-y divide-ink-100 dark:divide-white/5">
                @forelse ($recentQuotes as $q)
                    <li>
                        <a href="{{ route('admin.quotes.show', $q) }}" class="flex items-center gap-4 px-7 py-4 transition hover:bg-ink-50 dark:hover:bg-white/[0.03]">
                            <span class="grid size-11 shrink-0 place-items-center rounded-full bg-ink-950 text-sm font-bold text-go-400 dark:bg-white/10">{{ $q->initials() }}</span>
                            <span class="min-w-0 flex-1">
                                <span class="flex flex-wrap items-center gap-2"><span class="truncate font-semibold">{{ $q->name }}</span><x-status :status="$q->status" /></span>
                                <span class="mt-0.5 block truncate text-sm text-ink-500 dark:text-ink-400">{{ $q->from_postcode }} → {{ $q->to_postcode }} · {{ $q->sizeLabel() }} · {{ $q->created_at->diffForHumans() }}</span>
                            </span>
                            <span class="hidden w-36 shrink-0 sm:block">
                                <span class="flex justify-between text-xs"><span class="text-ink-500 dark:text-ink-400">Pipeline</span><span class="font-semibold">{{ $q->estimate ? '£'.number_format($q->estimate, 0) : '—' }}</span></span>
                                <span class="mt-1.5 block h-1.5 rounded-full bg-ink-100 dark:bg-white/10"><span class="block h-1.5 rounded-full {{ $q->status === 'lost' ? 'bg-ink-300' : 'bg-go-500' }}" style="width: {{ $q->progress() }}%"></span></span>
                            </span>
                        </a>
                    </li>
                @empty
                    <li class="px-7 py-12 text-center text-ink-500">No quote requests yet. They'll appear here as soon as someone uses the website form.</li>
                @endforelse
            </ul>
        </section>

        {{-- Upcoming moves --}}
        <section class="card overflow-hidden">
            <div class="flex items-center justify-between px-7 pt-7 pb-4">
                <h2 class="text-xl font-bold">Upcoming moves</h2>
                <a href="{{ route('admin.jobs') }}" class="text-sm font-semibold text-go-700 hover:underline dark:text-go-400">Schedule</a>
            </div>
            <ul class="divide-y divide-ink-100 dark:divide-white/5">
                @forelse ($upcomingJobs as $job)
                    <li>
                        <a href="{{ route('admin.quotes.show', $job) }}" class="flex items-center gap-4 px-7 py-4 transition hover:bg-ink-50 dark:hover:bg-white/[0.03]">
                            <span class="flex w-12 shrink-0 flex-col items-center rounded-xl bg-go-100 py-1.5 text-go-900 dark:bg-go-400/10 dark:text-go-300">
                                <span class="text-[10px] font-bold uppercase">{{ $job->move_date->format('M') }}</span>
                                <span class="font-display text-lg leading-none font-bold">{{ $job->move_date->format('j') }}</span>
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="block truncate font-semibold">{{ $job->name }}</span>
                                <span class="block truncate text-sm text-ink-500 dark:text-ink-400">{{ $job->serviceLabel() }} · {{ $job->move_date->isToday() ? 'Today' : $job->move_date->diffForHumans(['parts' => 1]) }}</span>
                            </span>
                            <span class="font-semibold">£{{ number_format($job->estimate, 0) }}</span>
                        </a>
                    </li>
                @empty
                    <li class="px-7 py-12 text-center text-ink-500">No booked moves coming up.</li>
                @endforelse
            </ul>
        </section>
    </div>
</x-layouts.admin>
