@php($ft = config('fasttrack'))
<x-layouts.admin title="New quote" :crumb="['Quotes', route('admin.quotes.index')]">
    <h1 class="text-3xl font-bold">Log a new lead</h1>
    <p class="mt-1 text-ink-500 dark:text-ink-400">For enquiries that came in by phone, WhatsApp, email or word of mouth. Website quotes are added automatically.</p>

    <form method="post" action="{{ route('admin.quotes.store') }}" class="mt-8 grid gap-6 xl:grid-cols-[1.5fr_1fr]">
        @csrf
        <div class="space-y-6">
            <section class="card p-7">
                <h2 class="text-lg font-bold">Customer</h2>
                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name" class="field-label">Full name</label>
                        <input id="name" name="name" value="{{ old('name') }}" required maxlength="120" class="field" autofocus>
                        @error('name') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="phone" class="field-label">Phone</label>
                        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required class="field">
                        @error('phone') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="email" class="field-label">Email <span class="font-normal text-ink-400">(optional)</span></label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="field">
                        @error('email') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            <section class="card p-7">
                <h2 class="text-lg font-bold">The move</h2>
                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="service" class="field-label">Service</label>
                        <select id="service" name="service" class="field">
                            @foreach ($ft['services'] as $slug => $s)
                                <option value="{{ $slug }}" @selected(old('service', 'home-removals') === $slug)>{{ $s['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="property_size" class="field-label">Property</label>
                        <select id="property_size" name="property_size" class="field">
                            @foreach ($ft['property_sizes'] as $key => $label)
                                <option value="{{ $key }}" @selected(old('property_size', '2-bed') === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="from_postcode" class="field-label">From (postcode)</label>
                        <input id="from_postcode" name="from_postcode" value="{{ old('from_postcode') }}" required maxlength="12" class="field uppercase">
                        @error('from_postcode') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="to_postcode" class="field-label">To (postcode)</label>
                        <input id="to_postcode" name="to_postcode" value="{{ old('to_postcode') }}" required maxlength="12" class="field uppercase">
                        @error('to_postcode') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="move_date" class="field-label">Move date</label>
                        <input id="move_date" name="move_date" type="date" value="{{ old('move_date') }}" class="field">
                        @error('move_date') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <label class="flex items-center gap-3 self-end rounded-xl border border-ink-200 px-4 py-3 dark:border-ink-700">
                        <input type="checkbox" name="flexible_date" value="1" class="size-5 rounded accent-go-600" @checked(old('flexible_date'))>
                        <span class="text-sm font-medium">Dates are flexible</span>
                    </label>
                </div>
                <fieldset class="mt-5">
                    <legend class="field-label">Extras</legend>
                    <div class="grid gap-2 sm:grid-cols-2">
                        @foreach ($ft['extras'] as $key => $label)
                            <label class="flex items-center gap-3 rounded-xl border border-ink-200 px-4 py-3 has-checked:border-go-500 has-checked:bg-go-50 dark:border-ink-700 dark:has-checked:bg-go-400/10">
                                <input type="checkbox" name="extras[]" value="{{ $key }}" class="size-5 rounded accent-go-600" @checked(in_array($key, old('extras', [])))>
                                <span class="text-sm font-medium">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>
                <div class="mt-5">
                    <label for="notes" class="field-label">Notes</label>
                    <textarea id="notes" name="notes" rows="3" maxlength="2000" class="field" placeholder="Access, parking, special items…">{{ old('notes') }}</textarea>
                </div>
            </section>
        </div>

        <aside>
            <section class="card space-y-5 p-7 xl:sticky xl:top-28">
                <h2 class="text-lg font-bold">Pipeline</h2>
                <div>
                    <label for="source" class="field-label">Where did this lead come from?</label>
                    <select id="source" name="source" class="field">
                        @foreach (\App\Models\Quote::SOURCES as $key => $label)
                            @continue($key === 'website')
                            <option value="{{ $key }}" @selected(old('source', 'phone') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="status" class="field-label">Stage</label>
                    <select id="status" name="status" class="field">
                        @foreach (\App\Models\Quote::STATUSES as $key => $s)
                            <option value="{{ $key }}" @selected(old('status', 'contacted') === $key)>{{ $s['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="estimate" class="field-label">Fixed price (£) <span class="font-normal text-ink-400">(optional)</span></label>
                    <input id="estimate" name="estimate" type="number" step="0.01" min="0" value="{{ old('estimate') }}" class="field" placeholder="0.00">
                    @error('estimate') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <button class="btn-go w-full">Create quote <x-icon name="arrow-right" class="size-4" /></button>
                <a href="{{ route('admin.quotes.index') }}" class="btn-ghost w-full">Cancel</a>
            </section>
        </aside>
    </form>
</x-layouts.admin>
