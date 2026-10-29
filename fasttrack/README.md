# FastTrack — website & CRM

Laravel 13 marketing site and lightweight CRM for FastTrack Removals, built by Eaglescroft.

- **Public site:** home, services (+ one page per service), pricing, about, contact, a 4-step quote wizard.
- **CRM** (`/admin`): dashboard, quote pipeline (New → Contacted → Surveyed → Quote sent → Booked → Completed / Lost), quote detail with notes and activity log, manual entry for phone/WhatsApp/referral leads with lead source, CSV export, jobs schedule, customers, enquiries inbox. Light and dark mode.
- **Email:** staff get an alert for every quote and enquiry (reply goes straight to the customer); customers get a branded confirmation with their reference. A mail failure is logged but never loses the lead.
- **SEO:** per-page titles and descriptions, Open Graph tags, `MovingCompany` structured data, `/sitemap.xml`, `/robots.txt`, branded 404.

Stack: Laravel 13, Blade, Tailwind CSS 4, Alpine.js, Vite, SQLite (any Laravel-supported database works).

## Setup

```bash
composer install
cp .env.example .env && php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed      # seeds demo quotes + a staff login
npm install && npm run build
php artisan serve               # http://localhost:8000
```

Demo staff login: `admin@fasttrack.test` / `password`. Change it before going live.

Run tests with `php artisan test`.

## Email

`.env.example` uses `MAIL_MAILER=log`, so emails are written to `storage/logs/laravel.log` during development. For production, set the SMTP (or Postmark, Resend, SES…) `MAIL_*` values and `FASTTRACK_NOTIFY_EMAIL`, the inbox that receives new-lead alerts.

## Before launch

All business content lives in `config/fasttrack.php`. Items marked `PLACEHOLDER` need FastTrack's real details:

- Phone, WhatsApp number, address, opening hours, response-time promise (`FASTTRACK_PHONE`, `FASTTRACK_WHATSAPP`, `FASTTRACK_EMAIL` can be set in `.env`).
- Service "from" prices and the pricing page guide figures (`resources/views/pages/pricing.blade.php`).
- Testimonials: the current ones are layout placeholders and must be replaced with genuine reviews.
- About-page story copy.
- Logo: `resources/views/components/logo.blade.php` and `public/favicon.svg` are placeholders.

## Brand tokens

Colours are defined once in `resources/css/app.css` under `@theme`:

- `ink-*`: deep navy base colour.
- `go-*`: signal-lime accent.

Swap those two scales to re-skin the whole site and CRM.
