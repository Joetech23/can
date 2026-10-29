<x-layouts.admin title="Enquiries">
    <h1 class="text-3xl font-bold">Enquiries</h1>
    <p class="mt-1 text-ink-500 dark:text-ink-400">Messages from the website contact form. Unread first.</p>

    <div class="mt-6 space-y-3">
        @forelse ($enquiries as $e)
            <article @class(['card p-6', 'border-l-4 border-l-go-400' => ! $e->read_at]) x-data="{ open: {{ $e->read_at ? 'false' : 'true' }} }">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <button type="button" class="flex items-center gap-3 text-left" @click="open = !open" :aria-expanded="open">
                        <span class="grid size-10 place-items-center rounded-full {{ $e->read_at ? 'bg-ink-100 text-ink-500 dark:bg-white/5' : 'bg-go-400 text-ink-950' }} text-sm font-bold">{{ strtoupper(substr($e->name, 0, 1)) }}</span>
                        <span>
                            <span class="block font-semibold">{{ $e->name }} <span class="ml-2 rounded-full bg-ink-50 px-2 py-0.5 text-xs font-medium text-ink-600 dark:bg-white/5 dark:text-ink-300">{{ $e->topic }}</span></span>
                            <span class="block text-sm text-ink-500 dark:text-ink-400">{{ $e->email }}@if ($e->phone) · {{ $e->phone }}@endif · {{ $e->created_at->diffForHumans() }}</span>
                        </span>
                    </button>
                    <div class="flex gap-2">
                        <a href="mailto:{{ $e->email }}" class="btn-ghost py-2"><x-icon name="mail" class="size-4" /> Reply</a>
                        <form method="post" action="{{ route('admin.enquiries.update', $e) }}">@csrf @method('patch')
                            <button class="btn-ghost py-2">{{ $e->read_at ? 'Mark unread' : 'Mark read' }}</button>
                        </form>
                    </div>
                </div>
                <p x-show="open" x-collapse class="mt-4 leading-relaxed whitespace-pre-line text-ink-700 dark:text-ink-200">{{ $e->message }}</p>
            </article>
        @empty
            <div class="card flex flex-col items-center px-6 py-16 text-center">
                <x-icon name="inbox" class="size-10 text-ink-300" />
                <p class="mt-4 font-semibold">Inbox zero</p>
                <p class="mt-1 text-sm text-ink-500">New contact form messages will appear here.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-6">{{ $enquiries->links() }}</div>
</x-layouts.admin>
