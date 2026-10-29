@php($ft = config('fasttrack'))
<x-layouts.site title="Contact" description="Call, WhatsApp or message FastTrack Team Logistics. We reply fast.">
    <x-page-hero eyebrow="Contact" title="Talk to a real person." :lead="'Call, WhatsApp or send a message. We reply '.$ft['response_time'].'.'" :crumbs="['Contact' => null]" />

    <section class="py-16 lg:py-24">
        <div class="container-page grid gap-8 lg:grid-cols-[1fr_1.5fr]">
            <div class="space-y-3">
                @foreach ([
                    ['phone', 'Call us', $ft['phone'], 'tel:'.preg_replace('/\s+/', '', $ft['phone'])],
                    ['message-circle', 'WhatsApp', 'Message us any time', 'https://wa.me/'.$ft['whatsapp']],
                    ['mail', 'Email', $ft['email'], 'mailto:'.$ft['email']],
                    ['navigation', 'Already booked?', 'Track your move', route('track')],
                ] as [$icon, $label, $value, $href])
                    <a href="{{ $href }}" class="group flex items-center gap-4 rounded-lg border border-ink-200 p-5 transition hover:border-ink-950">
                        <span class="grid size-12 shrink-0 place-items-center rounded-md bg-ink-950 text-white transition group-hover:bg-go-600"><x-icon :name="$icon" /></span>
                        <span class="flex-1">
                            <span class="block text-sm text-ink-500">{{ $label }}</span>
                            <span class="block font-semibold text-ink-950">{{ $value }}</span>
                        </span>
                        <x-icon name="arrow-right" class="size-4 text-ink-300 transition group-hover:translate-x-1 group-hover:text-ink-950" />
                    </a>
                @endforeach
                <div class="rounded-lg bg-ink-950 p-6 text-white">
                    <p class="label-caps text-go-400">Opening hours</p>
                    <p class="mt-2 text-white/75">{{ $ft['hours'] }}</p>
                    <p class="label-caps mt-5 text-go-400">Based in</p>
                    <p class="mt-2 text-white/75">{{ $ft['address'] }}</p>
                </div>
            </div>

            <div class="rounded-lg border border-ink-200 border-t-4 border-t-go-500 p-6 sm:p-10">
                @if (session('sent'))
                    <div class="flex flex-col items-center py-12 text-center">
                        <span class="grid size-16 place-items-center rounded-full bg-go-600 text-white"><x-icon name="check" class="size-8" /></span>
                        <h2 class="mt-6 text-3xl text-ink-950">Message sent.</h2>
                        <p class="mt-2 max-w-sm text-ink-600">Thanks. Someone from the team will get back to you {{ $ft['response_time'] }}.</p>
                        <a href="{{ route('home') }}" class="btn-ghost mt-6">Back to home</a>
                    </div>
                @else
                    <h2 class="text-2xl text-ink-950">Send a message</h2>
                    <p class="mt-1 text-ink-600">Need a price? The <a href="{{ route('quote') }}" class="font-semibold text-go-600 underline underline-offset-4">instant quote</a> is quicker.</p>
                    <form method="post" action="{{ route('contact.store') }}" class="mt-8 grid gap-5 sm:grid-cols-2">
                        @csrf
                        <div>
                            <label for="name" class="field-label">Your name</label>
                            <input id="name" name="name" value="{{ old('name') }}" required autocomplete="name" class="field">
                            @error('name') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone" class="field-label">Phone <span class="font-normal text-ink-400">(optional)</span></label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel" class="field">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="email" class="field-label">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="field">
                            @error('email') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <fieldset class="sm:col-span-2">
                            <legend class="field-label">What's it about?</legend>
                            <div class="flex flex-wrap gap-2">
                                @foreach (['General question', 'Existing booking', 'Office move', 'Pallet delivery', 'Storage', 'Careers'] as $topic)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="topic" value="{{ $topic }}" class="peer sr-only" @checked(old('topic', 'General question') === $topic)>
                                        <span class="inline-block rounded-md border border-ink-300 px-4 py-2 text-sm font-medium text-ink-700 transition peer-checked:border-ink-950 peer-checked:bg-ink-950 peer-checked:text-white peer-focus-visible:ring-2 peer-focus-visible:ring-go-500">{{ $topic }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </fieldset>
                        <div class="sm:col-span-2">
                            <label for="message" class="field-label">Message</label>
                            <textarea id="message" name="message" rows="5" required class="field">{{ old('message') }}</textarea>
                            @error('message') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex flex-col gap-3 sm:col-span-2 sm:flex-row sm:items-center sm:justify-between">
                            <p class="flex items-center gap-2 text-sm text-ink-500"><x-icon name="lock" class="size-4 text-go-600" /> We only use your details to reply. <a href="{{ route('legal.privacy') }}" class="underline underline-offset-2">Privacy</a></p>
                            <button class="btn-go">Send message <x-icon name="arrow-right" class="size-4" /></button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </section>
</x-layouts.site>
