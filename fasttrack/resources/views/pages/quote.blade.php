@php
    $ft = config('fasttrack');
    // After a failed submit, reopen the wizard on the first step with an error.
    $stepFields = [
        0 => ['service', 'from_postcode', 'to_postcode'],
        1 => ['property_size', 'move_date'],
        2 => ['extras', 'notes'],
        3 => ['name', 'email', 'phone'],
    ];
    $startStep = 0;
    foreach ($stepFields as $i => $fields) {
        if ($errors->hasAny($fields)) { $startStep = $i; break; }
    }
    $service = old('service', $prefill['service'] ?? 'home-removals');
    $size = old('property_size', $prefill['size'] ?? '2-bed');
    $extras = old('extras', []);
    $labels = ['Your route', 'Your home', 'Extras', 'Your details'];
@endphp
<x-layouts.site title="Get a free quote" description="Get a fixed-price removal quote in two minutes.">
    <section class="relative overflow-hidden bg-ink-50/60">
        <div class="pointer-events-none absolute -top-40 -right-20 size-[520px] rounded-full bg-go-200/50 blur-3xl"></div>
        <div class="container-page relative grid gap-10 py-10 lg:grid-cols-[1.5fr_1fr] lg:py-16" x-data="quoteWizard({{ $startStep }})">
            <div x-ref="wizard" class="scroll-mt-28">
                <p class="eyebrow"><span class="h-px w-6 bg-go-600"></span> Free quote · 2 minutes</p>
                <h1 class="mt-3 text-4xl font-extrabold text-ink-950 sm:text-5xl">Let's price your move.</h1>

                {{-- Progress --}}
                <ol class="mt-8 grid grid-cols-4 gap-2" aria-label="Progress">
                    @foreach ($labels as $i => $label)
                        <li>
                            <span class="block h-1.5 rounded-full transition-colors duration-300" :class="step >= {{ $i }} ? 'bg-go-500' : 'bg-ink-200'"></span>
                            <span class="mt-2 hidden text-xs font-semibold sm:block" :class="step >= {{ $i }} ? 'text-ink-950' : 'text-ink-400'">{{ $i + 1 }}. {{ $label }}</span>
                        </li>
                    @endforeach
                </ol>
                <p class="mt-3 text-sm font-medium text-ink-500 sm:hidden">Step <span x-text="step + 1"></span> of 4 · <span x-text="{{ json_encode($labels) }}[step]"></span></p>

                <form method="post" action="{{ route('quote.store') }}" class="card mt-6 p-6 shadow-xl shadow-ink-900/5 sm:p-8" novalidate x-on:submit="if (step < total - 1) { $event.preventDefault(); next(); }">
                    @csrf

                    {{-- Step 1: route --}}
                    <fieldset x-ref="step0" x-show="step === 0" @if ($startStep !== 0) x-cloak @endif>
                        <legend class="text-xl font-bold text-ink-950">What are we moving?</legend>
                        <div class="mt-5 grid grid-cols-2 gap-2 sm:grid-cols-4">
                            @foreach ($ft['services'] as $slug => $s)
                                <label class="cursor-pointer">
                                    <input type="radio" name="service" value="{{ $slug }}" class="peer sr-only" @checked($service === $slug) required>
                                    <span class="flex h-full flex-col gap-2 rounded-2xl border border-ink-200 p-3 text-sm font-semibold text-ink-800 transition peer-checked:border-go-500 peer-checked:bg-go-50 peer-checked:ring-2 peer-checked:ring-go-400 peer-focus-visible:ring-2 peer-focus-visible:ring-go-400 hover:border-ink-300">
                                        <x-icon :name="$s['icon']" class="size-5 text-go-700" /> {{ $s['name'] }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('service') <p class="field-error">{{ $message }}</p> @enderror

                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="from_postcode" class="field-label">Moving from (postcode)</label>
                                <input id="from_postcode" name="from_postcode" value="{{ old('from_postcode', $prefill['from'] ?? '') }}" required maxlength="12" placeholder="e.g. SE1 7PB" class="field uppercase placeholder:normal-case" autocomplete="postal-code">
                                @error('from_postcode') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="to_postcode" class="field-label">Moving to (postcode)</label>
                                <input id="to_postcode" name="to_postcode" value="{{ old('to_postcode', $prefill['to'] ?? '') }}" required maxlength="12" placeholder="e.g. ME15 6JQ" class="field uppercase placeholder:normal-case">
                                @error('to_postcode') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- Step 2: property & date --}}
                    <fieldset x-ref="step1" x-show="step === 1" @if ($startStep !== 1) x-cloak @endif>
                        <legend class="text-xl font-bold text-ink-950">How big is the move?</legend>
                        <div class="mt-5 grid grid-cols-2 gap-2 sm:grid-cols-4">
                            @foreach ($ft['property_sizes'] as $key => $label)
                                <label class="cursor-pointer">
                                    <input type="radio" name="property_size" value="{{ $key }}" class="peer sr-only" @checked($size === $key) required>
                                    <span class="block rounded-2xl border border-ink-200 px-3 py-4 text-center text-sm font-semibold text-ink-800 transition peer-checked:border-go-500 peer-checked:bg-go-50 peer-checked:ring-2 peer-checked:ring-go-400 peer-focus-visible:ring-2 peer-focus-visible:ring-go-400 hover:border-ink-300">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('property_size') <p class="field-error">{{ $message }}</p> @enderror

                        <div class="mt-6 grid gap-4 sm:grid-cols-2 sm:items-end">
                            <div>
                                <label for="move_date" class="field-label">Preferred moving date</label>
                                <input id="move_date" name="move_date" type="date" min="{{ now()->toDateString() }}" value="{{ old('move_date') }}" class="field">
                                @error('move_date') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-ink-200 px-4 py-3">
                                <input type="checkbox" name="flexible_date" value="1" class="size-5 rounded accent-go-600" @checked(old('flexible_date'))>
                                <span class="text-sm font-medium text-ink-800">My dates are flexible <span class="block text-xs font-normal text-ink-500">Midweek moves are often cheaper</span></span>
                            </label>
                        </div>
                    </fieldset>

                    {{-- Step 3: extras --}}
                    <fieldset x-ref="step2" x-show="step === 2" @if ($startStep !== 2) x-cloak @endif>
                        <legend class="text-xl font-bold text-ink-950">Anything extra? <span class="text-base font-normal text-ink-500">(optional)</span></legend>
                        <div class="mt-5 grid gap-2 sm:grid-cols-2">
                            @foreach ($ft['extras'] as $key => $label)
                                <label class="flex cursor-pointer items-center gap-3 rounded-2xl border border-ink-200 px-4 py-3.5 transition has-checked:border-go-500 has-checked:bg-go-50 hover:border-ink-300">
                                    <input type="checkbox" name="extras[]" value="{{ $key }}" class="size-5 rounded accent-go-600" @checked(in_array($key, $extras))>
                                    <span class="text-sm font-medium text-ink-800">{{ $label }}</span>
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
                        <legend class="text-xl font-bold text-ink-950">Where should we send your price?</legend>
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
                        <p class="mt-5 flex items-start gap-2 rounded-xl bg-ink-50 p-4 text-sm text-ink-600"><x-icon name="shield-check" class="mt-0.5 size-4 shrink-0 text-go-700" /> We use your details only to prepare and send your quote. No spam, no sharing.</p>
                    </fieldset>

                    <div class="mt-8 flex items-center justify-between gap-3 border-t border-ink-100 pt-6">
                        <button type="button" class="btn-ghost" x-show="step > 0" x-cloak @click="back()"><x-icon name="chevron-left" class="size-4" /> Back</button>
                        <span x-show="step === 0"></span>
                        <button type="button" class="btn-ink" x-show="step < total - 1" @click="next()">Continue <x-icon name="arrow-right" class="size-4" /></button>
                        <button type="submit" class="btn-go" x-show="step === total - 1" x-cloak>Get my free quote <x-icon name="arrow-right" class="size-4" /></button>
                    </div>
                </form>
            </div>

            <aside class="space-y-4 lg:pt-28">
                <div class="relative overflow-hidden rounded-3xl bg-ink-950 p-7 text-white">
                    <div class="pointer-events-none absolute -top-16 -right-16 size-48 rounded-full bg-go-400/20 blur-3xl"></div>
                    <h2 class="text-xl font-bold">What happens next</h2>
                    <ol class="mt-5 space-y-4">
                        @foreach (['We reply '.$ft['response_time'], 'Quick video survey or call', 'Your fixed price, in writing'] as $i => $t)
                            <li class="flex items-center gap-3 text-sm"><span class="grid size-7 shrink-0 place-items-center rounded-full bg-go-400 text-xs font-bold text-ink-950">{{ $i + 1 }}</span> {{ $t }}</li>
                        @endforeach
                    </ol>
                </div>
                <div class="card p-6">
                    <ul class="space-y-3">
                        @foreach ($ft['trust'] as $item)
                            <li class="flex items-center gap-3 text-sm font-medium text-ink-800"><span class="grid size-9 place-items-center rounded-xl bg-go-100 text-go-800"><x-icon :name="$item['icon']" class="size-4" /></span> {{ $item['label'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <a href="tel:{{ preg_replace('/\s+/', '', $ft['phone']) }}" class="card flex items-center gap-3 p-5 hover:border-go-300">
                    <span class="grid size-10 place-items-center rounded-full bg-ink-950 text-go-400"><x-icon name="phone" class="size-4" /></span>
                    <span><span class="block text-sm text-ink-500">Rather talk?</span><span class="font-semibold text-ink-950">{{ $ft['phone'] }}</span></span>
                </a>
            </aside>
        </div>
    </section>
</x-layouts.site>
