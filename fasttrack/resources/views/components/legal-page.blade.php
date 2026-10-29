@props(['title', 'description', 'updated' => '29 October 2026'])
{{-- TEMPLATE TEXT: legal pages must be reviewed by FastTrack (and ideally a solicitor) before launch. --}}
<x-layouts.site :title="$title" :description="$description">
    <x-page-hero eyebrow="Legal" :title="$title" :lead="'Last updated '.$updated" :crumbs="[$title => null]" />
    <section class="py-14 lg:py-20">
        <div class="container-page grid gap-12 lg:grid-cols-[1fr_280px]">
            <article class="prose-ft max-w-3xl">{{ $slot }}</article>
            <aside class="lg:sticky lg:top-36 lg:self-start">
                <div class="rounded-lg border border-ink-200 p-6">
                    <h2 class="label-caps text-ink-500">Legal</h2>
                    <ul class="mt-3 divide-y divide-ink-200">
                        @foreach (['legal.privacy' => 'Privacy policy', 'legal.terms' => 'Terms & conditions', 'legal.cookies' => 'Cookie policy'] as $route => $label)
                            <li><a href="{{ route($route) }}" @class(['block py-3 font-medium', 'text-go-600' => request()->routeIs($route), 'text-ink-800 hover:text-go-600' => ! request()->routeIs($route)])>{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </section>
</x-layouts.site>
