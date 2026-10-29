@php
    $ft = config('fasttrack');
    // After a failed submit, reopen the wizard on the first step with an error.
    $stepFields = [
        0 => ['service', 'from_postcode', 'to_postcode'],
        1 => ['property_size', 'pallets', 'move_date'],
        2 => ['extras', 'notes'],
        3 => ['name', 'email', 'phone'],
    ];
    $startStep = 0;
    foreach ($stepFields as $i => $fields) {
        if ($errors->hasAny($fields)) { $startStep = $i; break; }
    }
    $service = old('service', $prefill['service'] ?? 'home-removals');
    $service = array_key_exists($service, $ft['services']) ? $service : 'home-removals';
    $size = old('property_size', $prefill['size'] ?? '2-bed');
    $extras = old('extras', []);
    $labels = ['Route', 'Size & date', 'Extras', 'Your details'];
@endphp
<x-layouts.site title="Instant quote" description="Get an instant removal, storage or pallet delivery price from FastTrack's rate card in two minutes.">
    <section class="bg-ink-950 text-white">
        <div class="container-page py-10 lg:py-14">
            <p class="eyebrow text-go-400">Instant quote · 2 minutes</p>
            <h1 class="mt-3 text-4xl sm:text-5xl">Let's price your move.</h1>
            <p class="mt-3 max-w-xl font-light text-white/65">Your estimate updates as you go, using FastTrack's own rates. We confirm a fixed price {{ $ft['response_time'] }}.</p>
        </div>
    </section>

    <section class="bg-ink-50" x-data="quoteWizard({{ $startStep }}, @js(route('quote.estimate')))">
        <div class="container-page grid gap-8 py-10 lg:grid-cols-[1.55fr_1fr] lg:py-14">
            <div x-ref="wizard" class="scroll-mt-36">
                {{-- Progress --}}
                <ol class="grid grid-cols-4 gap-2" aria-label="Progress">
                    @foreach ($labels as $i => $label)
                        <li>
                            <span class="block h-1.5 rounded-sm transition-colors duration-300" :class="step >= {{ $i }} ? 'bg-go-500' : 'bg-ink-200'"></span>
                            <span class="label-caps mt-2 hidden sm:block" :class="step >= {{ $i }} ? 'text-ink-950' : 'text-ink-400'">0{{ $i + 1 }} · {{ $label }}</span>
                        </li>
                    @endforeach
                </ol>
                <p class="label-caps mt-3 text-ink-500 sm:hidden">Step <span x-text="step + 1"></span> of 4 · <span x-text="@js($labels)[step]"></span></p>

                {{-- Compact live estimate for phones, where the full panel sits below the form. --}}
                <div class="mt-5 flex items-center justify-between rounded-lg bg-ink-950 px-5 py-3.5 text-white lg:hidden" x-show="estimate" x-cloak aria-hidden="true">
                    <span class="label-caps text-white/55">Instant estimate</span>
                    <span class="text-xl font-bold text-go-400"><span x-text="estimate && money(estimate.low)"></span> – <span x-text="estimate && money(estimate.high)"></span></span>
                </div>

                <form x-ref="form" method="post" action="{{ route('quote.store') }}" class="mt-6 rounded-lg border border-ink-200 bg-white p-6 shadow-xl shadow-ink-950/5 sm:p-8" novalidate x-on:submit="if (step < total - 1) { $event.preventDefault(); next(); }">
                    @csrf

                    {{-- Step 1: route --}}
                    <fieldset x-ref="step0" x-show="step === 0" @if ($startStep !== 0) x-cloak @endif>
                        <legend class="text-xl font-bold text-ink-950">What are we moving?</legend>
                        <div class="mt-5 grid grid-cols-2 gap-2 sm:grid-cols-3">
                            @foreach ($ft['services'] as $slug => $s)
                                <label class="cursor-pointer">
                                    <input type="radio" name="service" value="{{ $slug }}" class="peer sr-only" @checked($service === $slug) required>
                                    <span class="flex h-full items-center gap-3 rounded-md border border-ink-300 p-3.5 text-sm font-semibold text-ink-800 transition peer-checked:border-ink-950 peer-checked:bg-ink-950 peer-checked:text-white peer-focus-visible:ring-2 peer-focus-visible:ring-go-500 hover:border-ink-950">
                                        <x-icon :name="$s['icon']" class="size-5 shrink-0" /> {{ $s['name'] }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('service') <p class="field-error">{{ $message }}</p> @enderror

                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="from_postcode" class="field-label" x-text="service === 'pallet-delivery' ? 'Collection postcode' : 'Moving from (postcode)'">Moving from (postcode)</label>
                                <input id="from_postcode" name="from_postcode" value="{{ old('from_postcode', $prefill['from'] ?? '') }}" required maxlength="12" placeholder="e.g. SE1 7PB" class="field uppercase placeholder:normal-case" autocomplete="postal-code">
                                @error('from_postcode') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="to_postcode" class="field-label" x-text="service === 'pallet-delivery' ? 'Delivery postcode' : 'Moving to (postcode)'">Moving to (postcode)</label>
                                <input id="to_postcode" name="to_postcode" value="{{ old('to_postcode', $prefill['to'] ?? '') }}" required maxlength="12" placeholder="e.g. ME15 6JQ" class="field uppercase placeholder:normal-case">
                                @error('to_postcode') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- Step 2: size & date --}}
                    <fieldset x-ref="step1" x-show="step === 1" @if ($startStep !== 1) x-cloak @endif>
                        <div x-show="service !== 'pallet-delivery'">
                            <legend class="text-xl font-bold text-ink-950">How big is the move?</legend>
                            <div class="mt-5 grid grid-cols-2 gap-2 sm:grid-cols-4">
                                @foreach (collect($ft['property_sizes'])->except('pallet') as $key => $label)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="property_size" value="{{ $key }}" class="peer sr-only" @checked($size === $key) required :disabled="service === 'pallet-delivery'">
                                        <span class="block rounded-md border border-ink-300 px-3 py-4 text-center text-sm font-semibold text-ink-800 transition peer-checked:border-ink-950 peer-checked:bg-ink-950 peer-checked:text-white peer-focus-visible:ring-2 peer-focus-visible:ring-go-500 hover:border-ink-950">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('property_size') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div x-show="service === 'pallet-delivery'" x-cloak>
                            <legend class="text-xl font-bold text-ink-950">How many pallets?</legend>
                            <input type="hidden" name="property_size" value="pallet" :disabled="service !== 'pallet-delivery'" @disabled($service !== 'pallet-delivery')>
                            <div class="mt-5 flex items-center gap-3">
                                <label for="pallets" class="sr-only">Number of pallets</label>
                                <input id="pallets" name="pallets" type="number" min="1" max="26" value="{{ old('pallets', 1) }}" class="field w-32 text-lg font-semibold" :required="service === 'pallet-delivery'" :disabled="service !== 'pallet-delivery'">
                                <span class="text-sm text-ink-600">Standard or Euro pallets up to 1,000 kg each. Up to 26 per load.</span>
                            </div>
                            @error('pallets') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="mt-6 grid gap-4 sm:grid-cols-2 sm:items-end">
                            <div>
                                <label for="move_date" class="field-label" x-text="service === 'pallet-delivery' ? 'Collection date' : 'Preferred moving date'">Preferred moving date</label>
                                <input id="move_date" name="move_date" type="date" min="{{ now()->toDateString() }}" value="{{ old('move_date') }}" class="field">
                                @error('move_date') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <label class="flex cursor-pointer items-center gap-3 rounded-md border border-ink-300 px-4 py-3">
                                <input type="checkbox" name="flexible_date" value="1" class="size-5 rounded accent-go-600" @checked(old('flexible_date'))>
                                <span class="text-sm font-medium text-ink-800">My dates are flexible <span class="block text-xs font-normal text-ink-500">Weekday moves avoid the weekend surcharge</span></span>
                            </label>
                        </div>
                    </fieldset>

                    {{-- Step 3: extras --}}
                    <fieldset x-ref="step2" x-show="step === 2" @if ($startStep !== 2) x-cloak @endif>
                        <legend class="text-xl font-bold text-ink-950">Anything extra? <span class="text-base font-normal text-ink-500">(optional)</span></legend>
                        <div class="mt-5 grid gap-2 sm:grid-cols-2">
                            @foreach ($ft['extras'] as $key => $label)
                                <label class="flex cursor-pointer items-center gap-3 rounded-md border border-ink-300 px-4 py-3.5 transition has-checked:border-ink-950 has-checked:bg-ink-50 hover:border-ink-950">
                                    <input type="checkbox" name="extras[]" value="{{ $key }}" class="size-5 rounded accent-go-600" @checked(in_array($key, $extras))>
                                    <span class="flex-1 text-sm font-medium text-ink-800">{{ $label }}</span>
                                    <span class="text-xs font-semibold text-ink-500">{{ $key === 'packing' ? '+'.($rates['extras'][$key] * 100).'%' : '£'.$rates['extras'][$key] }}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            <label for="notes" class="field-label">Anything we should know?</label>
                            <textarea id="notes" name="notes" rows="4" maxlength="2000" placeholder="Stairs or lifts, parking, piano, items that need extra care…" class="field">{{ old('notes') }}</textarea>
                        </div>
                    </fieldset>

                    {{-- Step 4: contact --}}
                    <fieldset x-ref="step3" x-show="step === 3" @if ($startStep !== 3) x-cloak @endif>
                        <legend class="text-xl font-bold text-ink-950">Where should we send your quote?</legend>
                        <div class="mt-5 grid gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="name" class="field-label">Full name</label>
                                <input id="name" name="name" value="{{ old('name') }}" required maxlength="120" autocomplete="name" class="field">
                                @error('name') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="email" class="field-label">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="field">
                                @error('email') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="phone" class="field-label">Mobile</label>
                                <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required autocomplete="tel" class="field">
                                @error('phone') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <p class="mt-5 flex items-start gap-2 rounded-md bg-ink-50 p-4 text-sm text-ink-600"><x-icon name="lock" class="mt-0.5 size-4 shrink-0 text-go-600" /> We use your details only to prepare and send your quote. See our <a href="{{ route('legal.privacy') }}" class="font-semibold underline underline-offset-2">privacy policy</a>.</p>
                    </fieldset>

                    <div class="mt-8 flex items-center justify-between gap-3 border-t border-ink-200 pt-6">
                        <button type="button" class="btn-ghost" x-show="step > 0" x-cloak @click="back()"><x-icon name="chevron-left" class="size-4" /> Back</button>
                        <span x-show="step === 0"></span>
                        <button type="button" class="btn-ink" x-show="step < total - 1" @click="next()">Continue <x-icon name="arrow-right" class="size-4" /></button>
                        <button type="submit" class="btn-go" x-show="step === total - 1" x-cloak>Send my quote request <x-icon name="arrow-right" class="size-4" /></button>
                    </div>
                </form>
            </div>

            {{-- Live estimate --}}
            <aside class="space-y-4 lg:sticky lg:top-36 lg:self-start">
                <div class="overflow-hidden rounded-lg bg-ink-950 text-white shadow-xl" aria-live="polite">
                    <div class="flex items-center justify-between px-6 pt-6">
                        <p class="label-caps text-white/50">Your instant estimate</p>
                        <span class="size-2 rounded-full bg-go-500" :class="loading && 'animate-pulse-dot'"></span>
                    </div>
                    <div class="px-6 pt-2 pb-6">
                        <p class="text-4xl font-bold text-go-400" x-show="estimate" x-cloak>
                            <span x-text="estimate && money(estimate.low)"></span><span class="text-2xl text-white/50"> – </span><span x-text="estimate && money(estimate.high)"></span>
                        </p>
                        <p class="text-lg text-white/60" x-show="!estimate">Calculating…</p>
                        <p class="mt-2 text-sm text-white/55" x-show="estimate && estimate.miles" x-cloak>Approx. <span x-text="estimate && Math.round(estimate.miles)"></span> miles by road</p>
                        <p class="mt-2 text-sm text-white/55" x-show="estimate && !estimate.miles" x-cloak>Travel is added once both postcodes are found.</p>
                    </div>
                    <dl class="divide-y divide-white/10 border-t border-white/10 text-sm" x-show="estimate" x-cloak>
                        <template x-for="line in (estimate ? estimate.lines : [])" :key="line.label">
                            <div class="flex justify-between gap-4 px-6 py-2.5"><dt class="text-white/65" x-text="line.label"></dt><dd class="font-semibold" x-text="money(line.amount)"></dd></div>
                        </template>
                    </dl>
                    <p class="bg-white/5 px-6 py-3 text-xs text-white/50">Estimate from our standard rates. Your fixed price is confirmed after a quick survey.</p>
                </div>
                <div class="rounded-lg border border-ink-200 bg-white p-6">
                    <p class="label-caps text-ink-500">What happens next</p>
                    <ol class="mt-4 space-y-3">
                        @foreach (['We reply '.$ft['response_time'], 'Quick video survey or call', 'Fixed quote to accept online', 'Track your move with your reference'] as $i => $t)
                            <li class="flex items-center gap-3 text-sm text-ink-800"><span class="grid size-6 shrink-0 place-items-center rounded-sm bg-ink-950 font-condensed text-xs font-bold text-white">{{ $i + 1 }}</span> {{ $t }}</li>
                        @endforeach
                    </ol>
                </div>
                <a href="tel:{{ preg_replace('/\s+/', '', $ft['phone']) }}" class="flex items-center gap-3 rounded-lg border border-ink-200 bg-white p-5 hover:border-ink-950">
                    <span class="grid size-10 place-items-center rounded-md bg-go-600 text-white"><x-icon name="phone" class="size-4" /></span>
                    <span><span class="block text-sm text-ink-500">Rather talk?</span><span class="font-semibold text-ink-950">{{ $ft['phone'] }}</span></span>
                </a>
            </aside>
        </div>
    </section>
</x-layouts.site>
