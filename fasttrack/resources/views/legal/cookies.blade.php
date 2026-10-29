@php($ft = config('fasttrack'))
<x-legal-page title="Cookie policy" description="How the FastTrack website uses cookies and how to control them.">
    <p>Cookies are small files stored on your device when you visit a website. This page explains which cookies we use and how you can control them.</p>

    <h2>Essential cookies</h2>
    <p>These keep the site working and secure, for example remembering your progress through the quote form and protecting forms from abuse. They do not need your consent.</p>
    <ul>
        <li><strong>Session cookie:</strong> keeps you connected while you use the site.</li>
        <li><strong>XSRF-TOKEN:</strong> protects forms from cross-site request forgery.</li>
        <li><strong>ft-cookies (local storage):</strong> remembers your cookie choice.</li>
    </ul>

    <h2>Analytics cookies</h2>
    <p>With your consent we use Google Analytics to understand which pages are useful and how many quote requests the site produces. Data is aggregated and does not identify you directly.</p>

    <h2>Advertising cookies</h2>
    <p>With your consent we use the Meta (Facebook and Instagram) Pixel and TikTok Pixel to measure our adverts and show relevant ads to people who have visited the site.</p>

    <h2>Changing your choice</h2>
    <p>You can change your choice at any time:</p>
    <p><button type="button" class="btn-ghost not-prose" onclick="try { localStorage.removeItem('ft-cookies') } catch (e) {} location.reload()">Reset cookie preferences</button></p>
    <p>You can also block or delete cookies in your browser settings. Questions? Email <a href="mailto:{{ $ft['email'] }}">{{ $ft['email'] }}</a>.</p>
</x-legal-page>
