@props(['title' => 'Get your price in two minutes.', 'lead' => null, 'service' => null, 'from' => null])
<section class="bg-go-100">
    <div class="container-page flex flex-col items-start justify-between gap-6 py-12 md:flex-row md:items-center">
        <div>
            <h2 class="text-2xl text-ink-950 sm:text-3xl">{{ $title }}</h2>
            <p class="mt-2 text-ink-700">{{ $lead ?? 'Instant estimate online, fixed quote '.config('fasttrack.response_time').'.' }}</p>
        </div>
        <a href="{{ route('quote', array_filter(['service' => $service, 'from' => $from])) }}" class="btn-go shrink-0">Get an instant quote <x-icon name="arrow-right" class="size-4" /></a>
    </div>
</section>
