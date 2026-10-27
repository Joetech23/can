<x-layouts.app title="Launch check" bare noindex>
    @php
        $badges = ['ok' => 'bg-emerald-100 text-emerald-800', 'warn' => 'bg-amber-100 text-amber-800', 'fail' => 'bg-red-100 text-red-700'];
        $words = ['ok' => 'Ready', 'warn' => 'Check', 'fail' => 'Fix'];
    @endphp

    <section class="min-h-screen bg-ivory py-16">
        <div class="container-x max-w-4xl">
            <x-logo />
            <h1 class="mt-10 font-display text-4xl text-navy-900">Website launch check</h1>
            <p class="mt-3 text-mist">Private page: confirms that email, the CRM and tracking work on this server. Remove <code>LAUNCH_CHECK_KEY</code> from <code>.env</code> after launch to switch it off.</p>

            @if (session('launch_result'))
                <p @class(['mt-8 rounded-2xl px-5 py-4 font-medium', 'bg-emerald-100 text-emerald-900' => session('launch_result.ok'), 'bg-red-100 text-red-800' => ! session('launch_result.ok')])>{{ session('launch_result.message') }}</p>
            @endif
            @if ($errors->any())
                <p class="mt-8 rounded-2xl bg-red-100 px-5 py-4 font-medium text-red-800">{{ $errors->first() }}</p>
            @endif

            <ul class="card-light mt-8 divide-y divide-navy-900/8">
                @foreach ($checks as $check)
                    <li class="flex flex-col gap-2 p-5 sm:flex-row sm:items-start sm:gap-5">
                        <span class="w-16 shrink-0 rounded-full px-3 py-1 text-center text-xs font-bold uppercase {{ $badges[$check['status']] }}">{{ $words[$check['status']] }}</span>
                        <div>
                            <p class="font-semibold text-navy-900">{{ $check['label'] }}</p>
                            <p class="mt-1 text-sm break-words text-mist">{{ $check['detail'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>

            <h2 class="mt-12 font-display text-2xl text-navy-900">Where enquiries go</h2>
            <ul class="card-light mt-4 divide-y divide-navy-900/8 text-sm">
                @foreach ($routes as $route)
                    <li class="flex flex-col justify-between gap-1 p-4 sm:flex-row"><span class="text-navy-900">{{ $route['label'] }}</span><span class="text-mist">{{ $route['email'] }}</span></li>
                @endforeach
            </ul>

            <h2 class="mt-12 font-display text-2xl text-navy-900">Run the tests</h2>
            <div class="mt-4 grid grid-cols-1 gap-5 md:grid-cols-2">
                <form method="POST" action="{{ route('launch-check.email') }}" class="card-light p-6">
                    @csrf
                    <input type="hidden" name="key" value="{{ $key }}">
                    <p class="font-semibold text-navy-900">1. Test email</p>
                    <p class="mt-1 text-sm text-mist">Sends a sample enquiry email in the real format.</p>
                    <label for="to" class="mt-4 block text-sm font-semibold text-navy-900">Send to</label>
                    <input id="to" name="to" type="email" value="{{ old('to', config('acpl.company.email')) }}" class="field mt-2 !py-3">
                    <button type="submit" class="btn-gold mt-4 w-full">Send test email</button>
                </form>

                <form method="POST" action="{{ route('launch-check.crm') }}" class="card-light p-6">
                    @csrf
                    <input type="hidden" name="key" value="{{ $key }}">
                    <p class="font-semibold text-navy-900">2. Test CRM ({{ config('acpl.crm.name') }})</p>
                    <p class="mt-1 text-sm text-mist">Posts a test lead marked <code>"test": true</code> to the CRM webhook.</p>
                    <button type="submit" class="btn-gold mt-4 w-full">Send test lead</button>
                </form>
            </div>

            <div class="card-light mt-5 p-6 text-sm leading-relaxed text-mist">
                <p class="font-semibold text-navy-900">3. Full form and tracking test</p>
                <ol class="mt-3 list-decimal space-y-2 pl-5">
                    <li>Open Google Analytics → Reports → <strong>Realtime</strong> (and Meta Events Manager → <strong>Test events</strong>, if the Pixel is set).</li>
                    <li>In another tab, visit the <a href="{{ route('home') }}" target="_blank" class="text-gold-700 underline">home page</a> — your visit should appear in Realtime within a minute.</li>
                    <li>Go to the <a href="{{ route('landing') }}#questionnaire" target="_blank" class="text-gold-700 underline">landing page questionnaire</a>, answer it, and submit the contact form with the name <strong>TEST – please ignore</strong>.</li>
                    <li>Confirm: the thank-you page shows; the enquiry email arrives with the questionnaire answers; a <strong>generate_lead</strong> event shows in GA Realtime (and <strong>Lead</strong> in Meta); the lead appears in the CRM.</li>
                </ol>
            </div>
        </div>
    </section>
</x-layouts.app>
