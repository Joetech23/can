<x-layouts.app :title="$article['title']" :description="$article['excerpt']">
    <section class="on-dark grain relative isolate overflow-hidden bg-navy-950 pt-36 pb-20 text-white sm:pt-44 sm:pb-24">
        <div class="grid-lines absolute inset-0 -z-10"></div>
        <div class="absolute -top-32 -right-32 -z-10 size-[36rem] rounded-full bg-navy-600/40 blur-[120px]"></div>
        <canvas data-ribbons="6" class="absolute inset-0 -z-10 h-full w-full opacity-60"></canvas>

        <div class="container-x mx-auto max-w-3xl">
            <a href="{{ route('insights') }}" class="inline-flex items-center gap-2 text-sm text-white/60 transition hover:text-gold-300" data-reveal>
                <x-icon name="arrow-right" class="size-4 rotate-180" stroke="2" /> All insights
            </a>
            <p class="mt-10 text-xs font-semibold tracking-[0.22em] text-gold-400 uppercase" data-reveal>{{ $article['category'] }}</p>
            <h1 class="mt-5 font-display text-4xl leading-[1.08] text-balance sm:text-6xl" data-reveal style="--reveal-delay: 80ms">{{ $article['title'] }}</h1>
            <p class="mt-8 flex flex-wrap items-center gap-4 text-sm text-white/55" data-reveal style="--reveal-delay: 160ms">
                <time datetime="{{ $article['date'] }}">{{ \Illuminate\Support\Carbon::parse($article['date'])->format('j F Y') }}</time>
                <span class="h-px w-6 bg-white/20"></span>
                {{ $article['author'] }}
            </p>
        </div>
    </section>

    <article class="bg-white py-20 sm:py-24">
        <div class="container-x mx-auto max-w-3xl">
            <p class="font-serif text-2xl leading-relaxed text-navy-800 italic sm:text-3xl">{{ $article['excerpt'] }}</p>
            <div class="mt-12 space-y-6 text-lg leading-relaxed text-ink/80">
                @foreach ($article['body'] as $paragraph)
                    @if (str_starts_with($paragraph, '## '))
                        <h2 class="pt-6 font-display text-3xl text-navy-900">{{ substr($paragraph, 3) }}</h2>
                    @else
                        <p>{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>

            <div class="mt-16 flex flex-col gap-6 rounded-3xl bg-ivory p-8 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="font-display text-2xl text-navy-900">Let’s talk about your next move.</p>
                    <p class="mt-1 text-mist">Speak confidentially with our team.</p>
                </div>
                <a href="{{ route('contact') }}#enquire" class="btn-gold shrink-0">Start a conversation <x-icon name="arrow-right" class="size-4" stroke="2" /></a>
            </div>
        </div>
    </article>

    @if ($related->isNotEmpty())
        <section class="bg-sand py-20 sm:py-24">
            <div class="container-x">
                <x-section-heading eyebrow="Keep reading" title="More insights." />
                <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2">
                    @foreach ($related as $other)
                        <a href="{{ route('insights.show', $other['slug']) }}" class="card-light group p-8 transition duration-500 hover:-translate-y-1" data-reveal>
                            <p class="text-xs font-semibold tracking-[0.22em] text-gold-600 uppercase">{{ $other['category'] }}</p>
                            <p class="mt-3 font-display text-2xl text-navy-900 transition group-hover:text-gold-600">{{ $other['title'] }}</p>
                            <p class="mt-3 text-mist">{{ $other['excerpt'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
