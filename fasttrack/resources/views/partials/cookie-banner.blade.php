{{-- Cookie notice. Analytics and ad pixels (proposal sections 06 and 08) must only load after "Accept". --}}
<div x-data="cookieBanner" x-show="show" x-cloak x-transition
     class="fixed inset-x-3 bottom-20 z-50 mx-auto max-w-xl rounded-lg border border-ink-200 bg-white p-5 shadow-2xl md:bottom-24 md:left-6 md:mx-0" role="dialog" aria-label="Cookie preferences">
    <div class="flex gap-4">
        <x-icon name="cookie" class="mt-0.5 size-6 shrink-0 text-go-600" />
        <div>
            <p class="font-semibold text-ink-950">We use cookies</p>
            <p class="mt-1 text-sm text-ink-600">Essential cookies keep the site working. With your permission we also use analytics and advertising cookies to see which pages help people most. <a href="{{ route('legal.cookies') }}" class="font-semibold text-go-600 underline underline-offset-2">Cookie policy</a></p>
            <div class="mt-4 flex flex-wrap gap-2">
                <button type="button" class="btn-go px-4 py-2 text-sm" @click="choose('all')">Accept all</button>
                <button type="button" class="btn-ghost px-4 py-2 text-sm" @click="choose('essential')">Essential only</button>
            </div>
        </div>
    </div>
</div>
