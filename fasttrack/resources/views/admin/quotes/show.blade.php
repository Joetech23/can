@php($ft = config('fasttrack'))
<x-layouts.admin :title="$quote->reference" :crumb="['Quotes', route('admin.quotes.index')]">
    <div class="flex flex-col justify-between gap-4 lg:flex-row lg:items-center">
        <div class="flex items-center gap-4">
            <span class="grid size-14 place-items-center rounded-2xl bg-ink-950 font-display text-lg font-bold text-go-400 dark:bg-white/10">{{ $quote->initials() }}</span>
            <div>
                <h1 class="flex flex-wrap items-center gap-3 text-3xl font-bold">{{ $quote->name }} <x-status :status="$quote->status" class="text-sm" /></h1>
                <p class="mt-1 text-ink-500 dark:text-ink-400">{{ $quote->reference }} · requested {{ $quote->created_at->format('j M Y, H:i') }} via {{ $quote->source }}</p>
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="tel:{{ preg_replace('/\s+/', '', $quote->phone) }}" class="btn-ghost"><x-icon name="phone" class="size-4" /> Call</a>
            <a href="https://wa.me/{{ preg_replace('/\D+/', '', preg_replace('/^0/', '44', $quote->phone)) }}" target="_blank" class="btn-ghost"><x-icon name="message-circle" class="size-4" /> WhatsApp</a>
            <a href="mailto:{{ $quote->email }}?subject={{ rawurlencode('Your FastTrack quote '.$quote->reference) }}" class="btn-ink"><x-icon name="mail" class="size-4" /> Email</a>
        </div>
    </div>

    {{-- Pipeline stepper --}}
    <div class="card mt-6 overflow-x-auto p-5">
        <ol class="flex min-w-[640px] items-center">
            @php($keys = array_keys(array_diff_key(\App\Models\Quote::STATUSES, ['lost' => 1])))
            @php($current = array_search($quote->status, $keys))
            @foreach ($keys as $i => $key)
                <li class="flex flex-1 items-center gap-2 {{ $loop->last ? 'flex-none' : '' }}">
                    <span @class([
                        'grid size-8 shrink-0 place-items-center rounded-full text-xs font-bold',
                        'bg-go-400 text-ink-950' => $current !== false && $i < $current,
                        'bg-ink-950 text-go-400 ring-4 ring-go-200 dark:bg-white dark:text-ink-950 dark:ring-go-400/30' => $current === $i,
                        'bg-ink-100 text-ink-400 dark:bg-white/5' => $current === false || $i > $current,
                    ])>@if ($current !== false && $i < $current) <x-icon name="check" class="size-4" /> @else {{ $i + 1 }} @endif</span>
                    <span class="text-sm font-semibold whitespace-nowrap {{ $current === $i ? '' : 'text-ink-500 dark:text-ink-400' }}">{{ \App\Models\Quote::STATUSES[$key]['label'] }}</span>
                    @unless ($loop->last) <span class="mx-3 h-0.5 flex-1 rounded {{ $current !== false && $i < $current ? 'bg-go-400' : 'bg-ink-100 dark:bg-white/10' }}"></span> @endunless
                </li>
            @endforeach
        </ol>
        @if ($quote->status === 'lost') <p class="mt-3 text-sm font-medium text-ink-500">This quote was marked as lost.</p> @endif
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-[1.5fr_1fr]">
        <div class="space-y-6">
            {{-- Move details --}}
            <section class="card p-7">
                <h2 class="text-lg font-bold">Move details</h2>
                <div class="mt-5 flex items-center gap-4 rounded-2xl bg-ink-50 p-5 dark:bg-white/[0.03]">
                    <div class="flex-1">
                        <p class="text-xs font-semibold tracking-wider text-ink-500 uppercase dark:text-ink-400">From</p>
                        <p class="mt-1 font-display text-2xl font-bold">{{ $quote->from_postcode }}</p>
                    </div>
                    <div class="flex flex-1 items-center gap-2 text-go-600 dark:text-go-400">
                        <span class="h-0.5 flex-1 border-t-2 border-dashed border-current"></span>
                        <x-icon name="truck" class="size-6" />
                        <span class="h-0.5 flex-1 border-t-2 border-dashed border-current"></span>
                    </div>
                    <div class="flex-1 text-right">
                        <p class="text-xs font-semibold tracking-wider text-ink-500 uppercase dark:text-ink-400">To</p>
                        <p class="mt-1 font-display text-2xl font-bold">{{ $quote->to_postcode }}</p>
                    </div>
                </div>
                <dl class="mt-6 grid gap-x-6 gap-y-5 sm:grid-cols-3">
                    @foreach ([
                        'Service' => $quote->serviceLabel(),
                        'Property' => $quote->sizeLabel(),
                        'Move date' => ($quote->move_date?->format('D j M Y') ?? 'Not set').($quote->flexible_date ? ' (flexible)' : ''),
                        'Email' => $quote->email,
                        'Phone' => $quote->phone,
                        'Price' => $quote->estimate ? '£'.number_format($quote->estimate, 2) : 'Not priced yet',
                    ] as $label => $value)
                        <div>
                            <dt class="text-xs font-semibold tracking-wider text-ink-500 uppercase dark:text-ink-400">{{ $label }}</dt>
                            <dd class="mt-1 font-medium break-words">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
                @if ($quote->extras)
                    <div class="mt-6">
                        <p class="text-xs font-semibold tracking-wider text-ink-500 uppercase dark:text-ink-400">Extras requested</p>
                        <ul class="mt-2 flex flex-wrap gap-2">
                            @foreach ($quote->extras as $extra)
                                <li class="rounded-full bg-go-100 px-3 py-1 text-sm font-medium text-go-900 dark:bg-go-400/10 dark:text-go-200">{{ $ft['extras'][$extra] ?? $extra }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($quote->notes)
                    <div class="mt-6 rounded-2xl border border-ink-100 p-4 dark:border-white/10">
                        <p class="text-xs font-semibold tracking-wider text-ink-500 uppercase dark:text-ink-400">Customer notes</p>
                        <p class="mt-2 leading-relaxed whitespace-pre-line">{{ $quote->notes }}</p>
                    </div>
                @endif
            </section>

            {{-- Activity --}}
            <section class="card p-7">
                <h2 class="text-lg font-bold">Activity</h2>
                <form method="post" action="{{ route('admin.quotes.note', $quote) }}" class="mt-5">
                    @csrf
                    <label for="body" class="sr-only">Add a note</label>
                    <textarea id="body" name="body" rows="3" required class="field" placeholder="Log a call, survey notes, anything the team should know…"></textarea>
                    @error('body') <p class="field-error">{{ $message }}</p> @enderror
                    <div class="mt-3 flex justify-end"><button class="btn-ink py-2.5"><x-icon name="plus" class="size-4" /> Add note</button></div>
                </form>
                <ol class="relative mt-6 space-y-6 border-l-2 border-ink-100 pl-6 dark:border-white/10">
                    @foreach ($quote->activities as $a)
                        <li class="relative">
                            <span @class([
                                'absolute top-0.5 -left-[33px] grid size-4 place-items-center rounded-full ring-4 ring-white dark:ring-ink-900',
                                'bg-go-500' => $a->type === 'created',
                                'bg-sky-500' => $a->type === 'status',
                                'bg-amber-400' => $a->type === 'note',
                            ])></span>
                            <p class="leading-relaxed whitespace-pre-line">{{ $a->body }}</p>
                            <p class="mt-1 text-xs text-ink-500 dark:text-ink-400">{{ $a->user?->name ?? 'Website' }} · {{ $a->created_at->diffForHumans() }}</p>
                        </li>
                    @endforeach
                </ol>
            </section>
        </div>

        <aside class="space-y-6">
            <section class="card p-7 xl:sticky xl:top-28">
                <h2 class="text-lg font-bold">Update quote</h2>
                <form method="post" action="{{ route('admin.quotes.update', $quote) }}" class="mt-5 space-y-5">
                    @csrf @method('patch')
                    <div>
                        <label for="status" class="field-label">Stage</label>
                        <select id="status" name="status" class="field">
                            @foreach (\App\Models\Quote::STATUSES as $key => $s)
                                <option value="{{ $key }}" @selected($quote->status === $key)>{{ $s['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="estimate" class="field-label">Fixed price (£)</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center font-semibold text-ink-400">£</span>
                            <input id="estimate" name="estimate" type="number" step="0.01" min="0" value="{{ old('estimate', $quote->estimate) }}" class="field pl-8" placeholder="0.00">
                        </div>
                        @error('estimate') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="move_date" class="field-label">Move date</label>
                        <input id="move_date" name="move_date" type="date" value="{{ old('move_date', $quote->move_date?->toDateString()) }}" class="field">
                    </div>
                    <button class="btn-go w-full">Save changes</button>
                </form>

                @if ($history->isNotEmpty())
                    <div class="mt-7 border-t border-ink-100 pt-6 dark:border-white/10">
                        <h3 class="text-sm font-bold">Other quotes from this customer</h3>
                        <ul class="mt-3 space-y-2">
                            @foreach ($history as $h)
                                <li><a href="{{ route('admin.quotes.show', $h) }}" class="flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-ink-50 dark:hover:bg-white/5"><span>{{ $h->reference }} · {{ $h->created_at->format('M Y') }}</span><x-status :status="$h->status" /></a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </section>
        </aside>
    </div>
</x-layouts.admin>
