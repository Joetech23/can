@props(['status'])
@php
    $tone = \App\Models\Quote::STATUSES[$status]['tone'] ?? 'slate';
    $classes = [
        'sky' => 'bg-sky-50 text-sky-700 ring-sky-200 dark:bg-sky-400/10 dark:text-sky-300 dark:ring-sky-400/25',
        'violet' => 'bg-violet-50 text-violet-700 ring-violet-200 dark:bg-violet-400/10 dark:text-violet-300 dark:ring-violet-400/25',
        'amber' => 'bg-amber-50 text-amber-800 ring-amber-200 dark:bg-amber-400/10 dark:text-amber-300 dark:ring-amber-400/25',
        'orange' => 'bg-orange-50 text-orange-700 ring-orange-200 dark:bg-orange-400/10 dark:text-orange-300 dark:ring-orange-400/25',
        'go' => 'bg-go-100 text-go-800 ring-go-300 dark:bg-go-400/10 dark:text-go-300 dark:ring-go-400/30',
        'emerald' => 'bg-emerald-50 text-emerald-700 ring-emerald-200 dark:bg-emerald-400/10 dark:text-emerald-300 dark:ring-emerald-400/25',
        'slate' => 'bg-ink-50 text-ink-600 ring-ink-200 dark:bg-white/5 dark:text-ink-300 dark:ring-white/10',
    ][$tone];
@endphp
<span {{ $attributes->merge(['class' => 'pill '.$classes]) }}>{{ \App\Models\Quote::STATUSES[$status]['label'] ?? ucfirst($status) }}</span>
