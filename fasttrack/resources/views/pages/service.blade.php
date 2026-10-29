@php($ft = config('fasttrack'))
<x-layouts.site :title="$service['name']" :description="$service['summary']">
    <x-page-hero :eyebrow="'Services · '.$service['name']" :title="$service['name']" :lead="$service['summary']">
        <div class="mt-8 flex flex-wrap items-center gap-3">
            <a href="{{ route('quote', ['service' => $slug]) }}" class="btn-go">Get a fixed price <x-icon name="arrow-right" class="size-4" /></a>
            <a href="tel:{{ preg_replace('/\s+/', '', $ft['phone']) }}" class="btn-ghost"><x-icon name="phone" class="size-4" /> {{ $ft['phone'] }}</a>
            <span class="ml-1 text-sm font-semibold text-ink-700">{{ $service['from'] }}</span>
        </div>
    </x-page-hero>

    <section class="py-16 lg:py-24">
        <div class="container-page grid gap-10 lg:grid-cols-[1.3fr_1fr]">
            <div>
                <h2 class="text-3xl font-bold text-ink-950">What's included</h2>
                <ul class="mt-6 grid gap-3 sm:grid-cols-2">
                    @foreach ($service['points'] as $point)
                        <li class="card flex items-start gap-3 p-5" x-reveal="{{ $loop->index * 60 }}">
                            <span class="grid size-8 shrink-0 place-items-center rounded-full bg-go-400 text-ink-950"><x-icon name="check" class="size-4" /></span>
                            <span class="font-medium text-ink-800">{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>

                <h2 class="mt-14 text-3xl font-bold text-ink-950">How it works</h2>
                <ol class="mt-6 space-y-4">
                    @foreach ($ft['steps'] as $i => $step)
                        <li class="flex gap-4">
                            <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-ink-950 font-display font-bold text-go-400">{{ $i + 1 }}</span>
                            <span>
                                <span class="block font-semibold text-ink-950">{{ $step['title'] }}</span>
                                <span class="mt-1 block text-ink-600">{{ $step['body'] }}</span>
                            </span>
                        </li>
                    @endforeach
                </ol>
            </div>

            <aside class="space-y-4 lg:sticky lg:top-28 lg:self-start">
                <div class="relative overflow-hidden rounded-3xl bg-ink-950 p-7 text-white">
                    <div class="pointer-events-none absolute -top-20 -right-20 size-60 rounded-full bg-go-400/20 blur-3xl"></div>
                    <x-icon :name="$service['icon']" class="size-10 text-go-400" />
                    <h3 class="mt-5 text-2xl font-bold">Get your price in 2 minutes</h3>
                    <p class="mt-2 text-white/65">Tell us the basics and we will reply {{ $ft['response_time'] }}.</p>
                    <a href="{{ route('quote', ['service' => $slug]) }}" class="btn-go mt-6 w-full">Start my quote <x-icon name="arrow-right" class="size-4" /></a>
                    <ul class="mt-6 space-y-2 text-sm text-white/70">
                        @foreach ($ft['trust'] as $item)
                            <li class="flex items-center gap-2"><x-icon :name="$item['icon']" class="size-4 text-go-400" /> {{ $item['label'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card p-6">
                    <h3 class="font-semibold text-ink-950">Other services</h3>
                    <ul class="mt-3 divide-y divide-ink-100">
                        @foreach (collect($ft['services'])->except($slug)->take(4) as $otherSlug => $other)
                            <li><a href="{{ route('services.show', $otherSlug) }}" class="flex items-center justify-between py-3 text-sm font-medium text-ink-700 hover:text-ink-950"><span class="flex items-center gap-2"><x-icon :name="$other['icon']" class="size-4 text-go-700" /> {{ $other['name'] }}</span><x-icon name="chevron-right" class="size-4" /></a></li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </section>

    <section class="pb-20">
        <div class="container-page max-w-3xl">
            <h2 class="mb-6 text-3xl font-bold text-ink-950">Questions</h2>
            @include('partials.faq', ['faqs' => array_slice($ft['faqs'], 0, 4)])
        </div>
    </section>
</x-layouts.site>
