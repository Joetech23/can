<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Staff login · FastTrack CRM</title>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="grid min-h-dvh lg:grid-cols-2">
    <div class="relative hidden overflow-hidden bg-ink-950 p-12 text-white lg:flex lg:flex-col">
        <div class="pointer-events-none absolute -top-32 -right-32 size-[520px] rounded-full bg-go-400/20 blur-3xl"></div>
        <a href="{{ route('home') }}" class="relative"><x-logo inverse /></a>
        <div class="relative mt-auto">
            <p class="eyebrow text-go-400"><span class="h-px w-6 bg-go-400"></span> FastTrack CRM</p>
            <h1 class="mt-4 max-w-md text-5xl leading-[1.05] font-extrabold">Every lead, quote and move in one place.</h1>
            <ul class="mt-8 space-y-3 text-white/70">
                @foreach (['Website quote requests land here instantly', 'Track every lead from first call to completed move', 'See the week’s jobs and the pipeline at a glance'] as $line)
                    <li class="flex items-center gap-3"><span class="grid size-6 place-items-center rounded-full bg-go-400 text-ink-950"><x-icon name="check" class="size-3.5" /></span> {{ $line }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="flex items-center justify-center bg-ink-50 px-4 py-12 sm:px-8">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="lg:hidden"><x-logo /></a>
            <h2 class="mt-8 text-3xl font-bold text-ink-950 lg:mt-0">Welcome back</h2>
            <p class="mt-2 text-ink-600">Sign in to the FastTrack team workspace.</p>
            <form method="post" action="{{ route('login') }}" class="card mt-8 space-y-5 p-7 shadow-xl shadow-ink-900/5">
                @csrf
                <div>
                    <label for="email" class="field-label">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="field">
                    @error('email') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password" class="field-label">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="field">
                </div>
                <label class="flex items-center gap-2 text-sm text-ink-700"><input type="checkbox" name="remember" class="size-4 rounded accent-go-600"> Keep me signed in</label>
                <button class="btn-go w-full">Sign in <x-icon name="arrow-right" class="size-4" /></button>
            </form>
            <p class="mt-6 text-center text-sm text-ink-500"><a href="{{ route('home') }}" class="font-semibold text-ink-800 hover:underline">← Back to website</a></p>
        </div>
    </div>
</body>
</html>
