@php($ft = config('fasttrack'))
<x-layouts.site title="Track my move" description="Track your FastTrack removal or delivery with your reference number and postcode.">
    <x-page-hero eyebrow="Track my move" title="Where's my move?" lead="Enter the reference from your confirmation email and one of the postcodes on your booking." :crumbs="['Track my move' => null]">
        <form method="post" action="{{ route('track.lookup') }}" class="mt-8 grid max-w-3xl gap-2 rounded-lg bg-white p-2 sm:grid-cols-[1fr_1fr_auto]">
            @csrf
            <label>
                <span class="sr-only">Reference</span>
                <input name="reference" value="{{ old('reference', $quote?->reference) }}" required placeholder="Reference, e.g. FT-2481" class="w-full rounded-md px-4 py-3 text-[15px] font-semibold text-ink-950 uppercase placeholder:font-normal placeholder:normal-case placeholder:text-ink-400 focus:ring-2 focus:ring-go-500 focus:outline-none">
            </label>
            <label class="border-ink-200 sm:border-l">
                <span class="sr-only">Postcode</span>
                <input name="postcode" value="{{ old('postcode') }}" required placeholder="Postcode on the booking" class="w-full rounded-md px-4 py-3 text-[15px] font-semibold text-ink-950 uppercase placeholder:font-normal placeholder:normal-case placeholder:text-ink-400 focus:ring-2 focus:ring-go-500 focus:outline-none">
            </label>
            <button class="btn-go">Track <x-icon name="arrow-right" class="size-4" /></button>
        </form>
        @error('reference') <p class="mt-3 max-w-3xl rounded-md bg-red-500/15 px-4 py-3 text-sm font-medium text-red-200" role="alert">{{ $message }}</p> @enderror
    </x-page-hero>

    <section class="py-14 lg:py-20">
        <div class="container-page">
            @if ($quote)
                @php($stage = $quote->trackingStage())
                <div class="overflow-hidden rounded-lg border border-ink-200">
                    <div class="flex flex-col justify-between gap-4 bg-ink-950 px-6 py-5 text-white sm:flex-row sm:items-center">
                        <div>
                            <p class="label-caps text-white/50">{{ $quote->serviceLabel() }}</p>
                            <p class="mt-1 text-2xl font-bold">{{ $quote->reference }} · {{ $quote->from_postcode }} → {{ $quote->to_postcode }}</p>
                        </div>
                        <p class="text-white/70">{{ $quote->move_date ? $quote->move_date->format('l j F Y') : 'Date to be confirmed' }}</p>
                    </div>
                    <div class="h-1 bg-go-500"></div>
                    @if ($stage['closed'])
                        <p class="p-8 text-ink-700">This quote is closed. If you'd still like to move with us, <a href="{{ route('quote') }}" class="font-semibold text-go-600 underline">request a new quote</a> or call {{ $ft['phone'] }}.</p>
                    @else
                        <ol class="grid gap-px bg-ink-200 sm:grid-cols-5">
                            @foreach ($stage['steps'] as $i => $label)
                                <li @class(['flex items-center gap-3 p-5 sm:flex-col sm:items-start', 'bg-white' => $i !== $stage['current'], 'bg-go-50' => $i === $stage['current']])>
                                    <span @class([
                                        'grid size-9 shrink-0 place-items-center rounded-full',
                                        'bg-ink-950 text-white' => $i < $stage['current'],
                                        'bg-go-600 text-white animate-pulse-dot' => $i === $stage['current'],
                                        'border-2 border-ink-200 text-ink-300' => $i > $stage['current'],
                                    ])>
                                        @if ($i < $stage['current']) <x-icon name="check" class="size-4" /> @else <span class="font-condensed text-sm font-bold">{{ $i + 1 }}</span> @endif
                                    </span>
                                    <span>
                                        <span @class(['block font-semibold', 'text-ink-950' => $i <= $stage['current'], 'text-ink-400' => $i > $stage['current']])>{{ $label }}</span>
                                        @if ($i === $stage['current']) <span class="label-caps text-go-600">Current stage</span> @endif
                                    </span>
                                </li>
                            @endforeach
                        </ol>
                    @endif
                </div>
                <p class="mt-6 text-ink-600">Questions about your move? Call <a href="tel:{{ preg_replace('/\s+/', '', $ft['phone']) }}" class="font-semibold text-ink-950">{{ $ft['phone'] }}</a> or <a href="https://wa.me/{{ $ft['whatsapp'] }}?text={{ urlencode('Hi FastTrack, about my move '.$quote->reference) }}" class="font-semibold text-go-600 underline underline-offset-4">message us on WhatsApp</a>.</p>
            @else
                <div class="grid gap-px overflow-hidden rounded-lg border border-ink-200 bg-ink-200 md:grid-cols-3">
                    @foreach ([['file-text', 'Find your reference', 'It starts with FT- and is in your confirmation email and texts.'], ['map-pin', 'Use either postcode', 'The collection or delivery postcode on your booking.'], ['navigation', 'Follow every stage', 'From enquiry to booked, on the move and completed.']] as [$icon, $title, $body])
                        <div class="bg-white p-7"><x-icon :name="$icon" class="size-7 text-go-600" /><h2 class="mt-5 text-lg text-ink-950">{{ $title }}</h2><p class="mt-1 text-ink-600">{{ $body }}</p></div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layouts.site>
