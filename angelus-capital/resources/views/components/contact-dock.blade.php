@props(['raised' => false])

@php
    $company = config('acpl.company');
    $hasHubSpotChat = filled(config('acpl.hubspot.portal_id'));
    $actions = array_values(array_filter([
        ['label' => 'WhatsApp', 'icon' => 'whatsapp', 'href' => 'https://wa.me/'.$company['whatsapp'].'?text='.rawurlencode($company['whatsapp_message']), 'external' => true, 'class' => 'bg-[#25D366] text-white'],
        ['label' => 'Live chat', 'icon' => 'chat', 'href' => route('contact').'#enquire', 'external' => false, 'class' => 'bg-navy-700 text-white', 'chat' => $hasHubSpotChat],
        ['label' => 'Email us', 'icon' => 'mail', 'href' => 'mailto:'.$company['email'], 'external' => false, 'class' => 'bg-white text-navy-900'],
        ['label' => 'Call us', 'icon' => 'phone', 'href' => 'tel:'.$company['phone_href'], 'external' => false, 'class' => 'bg-white text-navy-900'],
        $company['linkedin'] ? ['label' => 'LinkedIn', 'icon' => 'linkedin', 'href' => $company['linkedin'], 'external' => true, 'class' => 'bg-[#0A66C2] text-white'] : null,
    ]));
@endphp

<div data-dock @class(['fixed right-4 z-40 flex flex-col items-end gap-3 sm:right-6 sm:bottom-6', 'bottom-24' => $raised, 'bottom-4' => ! $raised])>
    <ul id="contact-dock-menu" data-dock-menu class="pointer-events-none flex translate-y-3 flex-col items-end gap-2.5 opacity-0 transition duration-300 ease-out-expo">
        @foreach ($actions as $action)
            <li>
                <a href="{{ $action['href'] }}" @if ($action['external']) target="_blank" rel="noopener" @endif @if ($action['chat'] ?? false) data-hubspot-chat @endif tabindex="-1"
                   class="group flex items-center gap-3">
                    <span class="rounded-full bg-navy-950/90 px-3 py-1.5 text-xs font-semibold text-white shadow-lg backdrop-blur">{{ $action['label'] }}</span>
                    <span class="grid size-12 place-items-center rounded-full shadow-[0_10px_25px_-8px_rgba(0,0,0,0.45)] transition group-hover:scale-110 {{ $action['class'] }}">
                        <x-icon :name="$action['icon']" class="size-5" stroke="1.8" />
                    </span>
                </a>
            </li>
        @endforeach
    </ul>

    <div class="flex items-center gap-3">
        <a href="https://wa.me/{{ $company['whatsapp'] }}?text={{ rawurlencode($company['whatsapp_message']) }}" target="_blank" rel="noopener" data-dock-quick
           class="grid size-14 place-items-center rounded-full bg-[#25D366] text-white shadow-[0_14px_30px_-10px_rgba(37,211,102,0.8)] transition hover:scale-105" aria-label="Chat with us on WhatsApp">
            <x-icon name="whatsapp" class="size-7" stroke="1.7" />
        </a>
        <button type="button" data-dock-toggle aria-expanded="false" aria-controls="contact-dock-menu"
                class="relative grid size-14 place-items-center rounded-full bg-gradient-to-br from-gold-300 via-gold-500 to-ember text-navy-950 shadow-[0_14px_30px_-10px_rgba(239,125,16,0.8)] transition hover:scale-105">
            <span class="sr-only">Contact options</span>
            <span class="absolute inset-0 rounded-full bg-gold-400/50 motion-safe:animate-ping [animation-duration:2.5s]" data-dock-ping></span>
            <x-icon name="chat" class="relative size-6" stroke="1.8" data-dock-icon="open" />
            <x-icon name="close" class="relative hidden size-6" stroke="2" data-dock-icon="close" />
        </button>
    </div>
</div>
