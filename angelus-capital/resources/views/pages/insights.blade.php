<x-layouts.app title="News & Insights" description="Thought leadership, market outlook and updates from Angelus Capital Partners.">
    <x-page-hero index="05" eyebrow="News & insights" title="Perspectives on capital, growth and <span class='text-gold-gradient'>value creation.</span>" lead="Thought leadership, market outlook and updates from our team — on the sectors, transactions and ideas shaping Africa’s next growth cycle." />

    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x">
            @if ($articles->isEmpty())
                <div class="card-light mx-auto max-w-2xl p-12 text-center">
                    <x-icon name="news" class="mx-auto size-12 text-gold-500" stroke="1.2" />
                    <p class="mt-6 font-display text-3xl text-navy-900">Insights are on the way.</p>
                    <p class="mt-3 text-mist">Check back soon for our latest thinking.</p>
                </div>
            @else
                @php($featured = $articles->first())
                <a href="{{ route('insights.show', $featured['slug']) }}" class="on-dark grain group relative isolate grid grid-cols-1 overflow-hidden rounded-[2rem] bg-navy-900 text-white lg:grid-cols-[1.1fr_0.9fr]" data-reveal>
                    <div class="p-8 sm:p-12">
                        <p class="flex items-center gap-3 text-xs font-semibold tracking-[0.22em] text-gold-400 uppercase">
                            Featured · {{ $featured['category'] }}
                        </p>
                        <h2 class="mt-5 font-display text-4xl leading-tight text-balance transition group-hover:text-gold-200 sm:text-5xl">{{ $featured['title'] }}</h2>
                        <p class="mt-5 max-w-xl text-lg leading-relaxed text-white/65">{{ $featured['excerpt'] }}</p>
                        <p class="mt-8 flex items-center gap-4 text-sm text-white/50">
                            <time datetime="{{ $featured['date'] }}">{{ \Illuminate\Support\Carbon::parse($featured['date'])->format('j F Y') }}</time>
                            <span class="h-px w-6 bg-white/20"></span>
                            {{ $featured['author'] }}
                        </p>
                        <span class="mt-8 inline-flex items-center gap-2 font-semibold text-gold-300">Read the article <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" stroke="2" /></span>
                    </div>
                    <div class="relative hidden min-h-80 lg:block">
                        <div class="grid-lines absolute inset-0"></div>
                        <div class="absolute top-1/2 left-1/2 size-80 -translate-x-1/2 -translate-y-1/2 rounded-full bg-gold-500/20 blur-3xl"></div>
                        <img src="{{ asset('images/acpl-mark.webp') }}" alt="" width="317" height="288" class="absolute top-1/2 left-1/2 w-64 -translate-x-1/2 -translate-y-1/2 drop-shadow-[0_30px_60px_rgba(239,125,16,0.4)] transition duration-700 group-hover:scale-105 group-hover:rotate-[-4deg]">
                    </div>
                </a>

                @if ($articles->count() > 1)
                    <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($articles->skip(1) as $article)
                            <a href="{{ route('insights.show', $article['slug']) }}" class="card-light group flex flex-col p-8 transition duration-500 hover:-translate-y-1.5" data-reveal style="--reveal-delay: {{ ($loop->index % 3) * 90 }}ms">
                                <p class="text-xs font-semibold tracking-[0.22em] text-gold-600 uppercase">{{ $article['category'] }}</p>
                                <h3 class="mt-4 font-display text-2xl leading-snug text-navy-900 transition group-hover:text-gold-600">{{ $article['title'] }}</h3>
                                <p class="mt-4 flex-1 leading-relaxed text-mist">{{ $article['excerpt'] }}</p>
                                <p class="mt-6 flex items-center justify-between text-sm text-mist">
                                    <time datetime="{{ $article['date'] }}">{{ \Illuminate\Support\Carbon::parse($article['date'])->format('j M Y') }}</time>
                                    <x-icon name="arrow-up-right" class="size-5 text-gold-600 transition group-hover:translate-x-0.5 group-hover:-translate-y-0.5" />
                                </p>
                            </a>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </section>

    <x-cta-band title="Want to discuss these ideas?" lead="Our team is always open to a conversation about capital, growth and the opportunities ahead." />
</x-layouts.app>
