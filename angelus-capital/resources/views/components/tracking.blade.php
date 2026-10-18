@props(['conversion' => false])

@php
    $tracking = config('acpl.tracking');
@endphp

@if ($tracking['google_tag'])
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ urlencode($tracking['google_tag']) }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', @js($tracking['google_tag']));
        @if ($conversion)
            gtag('event', 'generate_lead');
            @if ($tracking['google_ads_conversion'])
                gtag('event', 'conversion', { send_to: @js($tracking['google_ads_conversion']) });
            @endif
        @endif
    </script>
@endif

@if ($tracking['meta_pixel'])
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', @js($tracking['meta_pixel']));
        fbq('track', 'PageView');
        @if ($conversion)
            fbq('track', 'Lead');
        @endif
    </script>
@endif

@if (filled(config('acpl.hubspot.portal_id')))
    {{-- HubSpot tracking code: visitor analytics, the hubspotutk cookie and live chat (if enabled in HubSpot). --}}
    <script id="hs-script-loader" async defer src="https://js.hs-scripts.com/{{ urlencode(config('acpl.hubspot.portal_id')) }}.js"></script>
@endif
