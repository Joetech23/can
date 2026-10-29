@php($ft = config('fasttrack'))
{{-- PLACEHOLDER story copy: replace with FastTrack's own history, team and accreditations (proposal section 03, "Content and photos"). --}}
<x-layouts.site title="About us" description="FastTrack Team Logistics: removals, storage and pallet delivery built around punctuality, care and fixed prices.">
    <x-page-hero eyebrow="About FastTrack" title="Removals and logistics, run like clockwork." lead="FastTrack Team Logistics moves homes, offices and freight. Every job is planned, priced up front and tracked from the yard to the final signature." :crumbs="['About' => null]" />

    <section class="py-16 lg:py-24">
        <div class="container-page grid items-center gap-12 lg:grid-cols-2">
            <div>
                <x-section-head num="01" eyebrow="Our story" title="Built by people who hated waiting for a quote." />
                <div class="prose-ft mt-6">
                    <p>FastTrack started with a simple idea: moving should feel like progress, not panic. That means a real price quickly, a crew that arrives when we said it would, and knowing exactly where your belongings are at every stage.</p>
                    <p>Today we run home and office removals, storage, man and van and pallet delivery from one team, one fleet and one system. Whether it is a single pallet or a five-bed house, the job gets the same planning and the same care.</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-px overflow-hidden rounded-lg bg-ink-200">
                @foreach ([['clock', 'On time', 'One-hour arrival windows on every job.'], ['shield-check', 'Careful', 'Wrapped, padded, strapped and insured.'], ['pound-sterling', 'Clear', 'Fixed price before you commit.'], ['navigation', 'Connected', 'Live tracking from booked to delivered.']] as [$icon, $title, $body])
                    <div @class(['p-7', 'bg-ink-950 text-white' => in_array($loop->index, [0, 3]), 'bg-white' => in_array($loop->index, [1, 2])]) x-reveal="{{ $loop->index * 80 }}">
                        <x-icon :name="$icon" class="size-7 text-go-500" />
                        <h3 class="mt-8 text-xl">{{ $title }}</h3>
                        <p class="mt-1 text-sm {{ in_array($loop->index, [0, 3]) ? 'text-white/60' : 'text-ink-600' }}">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-ink-950 py-16 text-white lg:py-24">
        <div class="container-page">
            <x-section-head num="02" eyebrow="How we work" title="The FastTrack standard." dark />
            <div class="mt-12 grid gap-px overflow-hidden rounded-lg bg-white/10 md:grid-cols-2 lg:grid-cols-4">
                @foreach ([['Trained crews', 'Uniformed, background-checked movers led by an experienced crew lead.'], ['Maintained fleet', 'Clean vans with tail-lifts, checked before every job.'], ['One coordinator', 'A single point of contact from first quote to final invoice.'], ['Responsible disposal', 'Unwanted items donated or recycled before anything is binned.']] as [$title, $body])
                    <div class="bg-ink-950 p-7">
                        <span class="font-condensed text-4xl font-bold text-go-500">0{{ $loop->iteration }}</span>
                        <h3 class="mt-4 text-lg">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-white/60">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-24">
        <div class="container-page grid gap-10 lg:grid-cols-[1fr_1.4fr] lg:items-center">
            <x-section-head num="03" eyebrow="Coverage" title="Where we work." lead="Local crews across the South East, with UK-wide moves and pallet delivery." />
            <ul class="flex flex-wrap gap-2">
                @foreach ($ft['areas'] as $slug => $area)
                    <li><a href="{{ route('areas.show', $slug) }}" class="chip py-2 hover:border-ink-950"><x-icon name="map-pin" class="size-4 text-go-600" /> {{ $area['name'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-cta-band title="Plan your move with us." />
</x-layouts.site>
