<x-layouts.app title="Contact" description="Contact Angelus Capital Partners Limited — 173 Ogudu Road, Ogudu, Lagos, Nigeria.">
    @php($company = config('acpl.company'))

    <x-page-hero index="06" eyebrow="Contact us" title="Let’s start a <span class='text-gold-gradient'>conversation.</span>" lead="We look forward to partnering with organizations seeking sustainable growth and transformational outcomes." />

    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-12 lg:grid-cols-12">
            {{-- Details --}}
            <aside class="flex flex-col gap-5 lg:col-span-5">
                @foreach ([
                    ['icon' => 'pin', 'label' => 'Visit', 'value' => implode(', ', $company['address']), 'href' => 'https://www.google.com/maps/search/?api=1&query='.urlencode($company['map_query'])],
                    ['icon' => 'phone', 'label' => 'Call', 'value' => $company['phone'], 'href' => 'tel:'.$company['phone_href']],
                    ['icon' => 'mail', 'label' => 'Email', 'value' => $company['email'], 'href' => 'mailto:'.$company['email']],
                ] as $detail)
                    <a href="{{ $detail['href'] }}" @if ($detail['icon'] === 'pin') target="_blank" rel="noopener" @endif class="card-light group flex items-center gap-5 p-6 transition duration-500 hover:-translate-y-1" data-reveal style="--reveal-delay: {{ $loop->index * 90 }}ms">
                        <span class="grid size-14 shrink-0 place-items-center rounded-2xl bg-navy-900 text-gold-300 transition group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950">
                            <x-icon :name="$detail['icon']" class="size-6" />
                        </span>
                        <span class="min-w-0">
                            <span class="block text-xs font-semibold tracking-[0.2em] text-gold-600 uppercase">{{ $detail['label'] }}</span>
                            <span class="mt-1 block font-medium break-words text-navy-900">{{ $detail['value'] }}</span>
                        </span>
                        <x-icon name="arrow-up-right" class="ml-auto size-5 shrink-0 text-navy-900/30 transition group-hover:text-gold-600" />
                    </a>
                @endforeach

                <div class="overflow-hidden rounded-3xl border border-navy-900/8 bg-white" data-reveal>
                    <iframe title="Map showing {{ $company['map_query'] }}" src="https://www.google.com/maps?q={{ urlencode($company['map_query']) }}&output=embed" class="h-72 w-full grayscale-[0.4]" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </aside>

            {{-- Form --}}
            <div class="lg:col-span-7">
                <div class="card-light p-8 sm:p-12" data-reveal="right">
                    @if (session('status'))
                        <div class="mb-8 flex items-start gap-4 rounded-2xl border border-gold-500/40 bg-gold-200/30 p-5 text-navy-900" role="status">
                            <span class="grid size-9 shrink-0 place-items-center rounded-full bg-gradient-to-br from-gold-300 to-ember text-navy-950"><x-icon name="check" class="size-5" stroke="2" /></span>
                            <p class="pt-1.5">{{ session('status') }}</p>
                        </div>
                    @endif

                    <h2 class="font-display text-3xl text-navy-900 sm:text-4xl">Send us an enquiry</h2>
                    <p class="mt-3 text-mist">Tell us a little about your organization and objectives. Fields marked * are required.</p>

                    <form method="POST" action="{{ route('contact.store') }}" class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2" novalidate>
                        @csrf

                        <div class="hidden" aria-hidden="true">
                            <label for="company_website">Leave this field empty</label>
                            <input type="text" id="company_website" name="company_website" tabindex="-1" autocomplete="off">
                        </div>

                        @foreach ([
                            ['name' => 'name', 'label' => 'Full name *', 'type' => 'text', 'autocomplete' => 'name'],
                            ['name' => 'email', 'label' => 'Email address *', 'type' => 'email', 'autocomplete' => 'email'],
                            ['name' => 'phone', 'label' => 'Phone number', 'type' => 'tel', 'autocomplete' => 'tel'],
                            ['name' => 'organization', 'label' => 'Organization', 'type' => 'text', 'autocomplete' => 'organization'],
                        ] as $field)
                            <div>
                                <label for="{{ $field['name'] }}" class="mb-2 block text-sm font-semibold text-navy-900">{{ $field['label'] }}</label>
                                <input type="{{ $field['type'] }}" id="{{ $field['name'] }}" name="{{ $field['name'] }}" value="{{ old($field['name']) }}" autocomplete="{{ $field['autocomplete'] }}" @class(['field', '!border-red-400' => $errors->has($field['name'])]) @error($field['name']) aria-invalid="true" aria-describedby="{{ $field['name'] }}-error" @enderror>
                                @error($field['name'])
                                    <p id="{{ $field['name'] }}-error" class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach

                        <fieldset class="sm:col-span-2">
                            <legend class="mb-3 block text-sm font-semibold text-navy-900">How can we help? *</legend>
                            <div class="flex flex-wrap gap-2">
                                @foreach (config('acpl.enquiry_types') as $value => $label)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="enquiry_type" value="{{ $value }}" class="peer sr-only" @checked(old('enquiry_type', 'advisory') === $value)>
                                        <span class="block rounded-full border border-navy-900/15 px-4 py-2.5 text-sm text-navy-800 transition peer-checked:border-navy-900 peer-checked:bg-navy-900 peer-checked:text-white peer-focus-visible:ring-4 peer-focus-visible:ring-gold-400/40 hover:border-navy-900/40">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('enquiry_type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </fieldset>

                        <div class="sm:col-span-2">
                            <label for="message" class="mb-2 block text-sm font-semibold text-navy-900">Message *</label>
                            <textarea id="message" name="message" rows="6" @class(['field resize-y', '!border-red-400' => $errors->has('message')]) @error('message') aria-invalid="true" aria-describedby="message-error" @enderror>{{ old('message') }}</textarea>
                            @error('message')
                                <p id="message-error" class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-4 sm:col-span-2 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-xs text-mist">We treat every enquiry in confidence.</p>
                            <button type="submit" class="btn-gold">Send enquiry <x-icon name="arrow-right" class="size-4" stroke="2" /></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
