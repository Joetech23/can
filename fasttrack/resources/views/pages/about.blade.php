@php($ft = config('fasttrack'))
{{-- PLACEHOLDER story copy: replace with FastTrack's own history and team details. --}}
<x-layouts.site title="About us" description="Meet FastTrack, a removals company built around punctuality, care and fixed prices.">
    <x-page-hero eyebrow="About FastTrack" title="Moving people forward, on time." lead="We started FastTrack because moving day should feel like progress, not panic. Every job is planned to the hour, priced up front and handled by people who care how your things arrive." />

    <section class="py-16 lg:py-24">
        <div class="container-page grid items-center gap-12 lg:grid-cols-2">
            <div class="grid grid-cols-2 gap-4">
                @foreach ([['On time', 'One-hour arrival windows, every job.', 'clock'], ['Careful', 'Wrapped, padded and strapped.', 'shield-check'], ['Clear', 'Fixed price, no hidden fees.', 'pound-sterling'], ['Connected', 'Text updates from the crew lead.', 'message-circle']] as [$t, $b, $i])
                    <div @class(['rounded-3xl p-6', 'bg-ink-950 text-white' => $loop->index === 0, 'bg-go-400 text-ink-950' => $loop->index === 3, 'card' => in_array($loop->index, [1, 2])]) x-reveal="{{ $loop->index * 80 }}">
                        <x-icon :name="$i" class="size-7 {{ $loop->index === 0 ? 'text-go-400' : '' }}" />
                        <h3 class="mt-8 text-xl font-bold">{{ $t }}</h3>
                        <p class="mt-1 text-sm {{ $loop->index === 0 ? 'text-white/65' : ($loop->index === 3 ? 'text-ink-900/75' : 'text-ink-600') }}">{{ $b }}</p>
                    </div>
                @endforeach
            </div>
            <div>
                <p class="eyebrow"><span class="h-px w-6 bg-go-600"></span> Our promise</p>
                <h2 class="mt-4 text-4xl font-bold text-ink-950">The same crew standards on a one-bed flat as a six-desk office.</h2>
                <p class="mt-5 text-lg leading-relaxed text-ink-600">Our movers are trained in-house, uniformed and led by an experienced crew lead on every job. We would rather do fewer moves well than squeeze in one more van run.</p>
                <ul class="mt-6 space-y-3">
                    @foreach (['Trained, uniformed and background-checked crews', 'Clean, well-maintained vans with tail-lifts', 'One coordinator from quote to final box', 'Responsible recycling and donation of unwanted items'] as $p)
                        <li class="flex gap-3 text-ink-800"><x-icon name="check-circle" class="mt-0.5 size-5 shrink-0 text-go-600" /> {{ $p }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('quote') }}" class="btn-go mt-8">Plan my move <x-icon name="arrow-right" class="size-4" /></a>
            </div>
        </div>
    </section>

    <section class="border-t border-ink-100 bg-ink-50/60 py-16">
        <div class="container-page text-center">
            <h2 class="text-3xl font-bold text-ink-950">Covering</h2>
            <ul class="mx-auto mt-6 flex max-w-3xl flex-wrap justify-center gap-2">
                @foreach ($ft['areas'] as $area)
                    <li class="chip bg-white py-2"><x-icon name="map-pin" class="size-4 text-go-700" /> {{ $area }}</li>
                @endforeach
            </ul>
        </div>
    </section>
</x-layouts.site>
