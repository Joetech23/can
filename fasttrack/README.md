# FastTrack Team Logistics: website & CRM

Laravel 13 website and CRM for FastTrack Team Logistics, built by Eaglescroft to the project proposal of 19 September 2026.

## Website (Phase 1)

- **Main pages:** Home, About, Pricing, Reviews, Contact, Get a Quote.
- **Service pages (6):** Home removals, Office moves, Packing, Storage, Man and van, Pallet delivery (`/services/{slug}`).
- **Area pages (10):** one per town (`/removals/{slug}`), plus `/areas`.
- **Customer tools:** instant quote with a live price estimate from the rate card, Track my move (reference + postcode), click-to-call, WhatsApp button.
- **Content & legal:** moving guides, FAQ, privacy policy, terms and conditions, cookie policy with consent banner.
- **SEO:** per-page titles and descriptions, Open Graph tags, `MovingCompany`, `Service`, `FAQPage` and `Article` structured data, `/sitemap.xml`, `/robots.txt`, branded 404.

## CRM (Phase 2, in progress)

`/admin`: dashboard, quote pipeline with activity log, manual phone/WhatsApp leads, CSV export, jobs schedule, customers, enquiries. Staff and customer emails for every new quote and enquiry.

## Stack

Laravel 13, Blade, Tailwind CSS 4, Alpine.js, Vite, SQLite (any Laravel-supported database works). Fonts: Barlow and Barlow Condensed (self-hosted via Fontsource).

## Setup

```bash
composer install
cp .env.example .env && php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed      # demo quotes + a staff login
npm install && npm run build
php artisan serve               # http://localhost:8000
```

Demo staff login: `admin@fasttrack.test` / `password`. Change it before going live.

Run tests with `php artisan test`.

## Brand

Taken from the proposal artwork and defined once in `resources/css/app.css` under `@theme`:

- `ink-*`: near-black `#101315` with warm-grey neutrals.
- `go-*`: burnt orange `#DB4D18`; `go-600` `#B83D0F` sits behind white text for WCAG AA contrast.

The FT logo is redrawn as SVG in `resources/views/components/logo-mark.blade.php`. Swap in FastTrack's original vector logo when supplied.

## Instant quote

`app/Services/QuoteEstimator.php` prices a job from `config/fasttrack.php` → `rates`. That covers crew and van hourly rates by property size, mileage beyond the included miles, pallets, extras, weekend and short-notice surcharges, and a low–high range. The pricing page reads the same rates, so the two always agree.

Distance comes from [postcodes.io](https://postcodes.io) (free, no API key) in `app/Services/PostcodeDistance.php`, cached for 30 days. If a postcode cannot be found or the API is unreachable, the estimate is shown without mileage. The server must be allowed to reach `api.postcodes.io`.

## Before launch (proposal section 03)

All business content lives in `config/fasttrack.php`. Items marked `PLACEHOLDER` need FastTrack's details:

- **Rates and pricing rules:** van sizes, crew and hourly rates, mileage, packing, storage, surcharges, deposit %.
- **Contact details:** phone, WhatsApp number, address, company number, opening hours (`FASTTRACK_*` values can be set in `.env`).
- **Areas:** the ten towns to feature at launch.
- **Reviews:** the current ones are layout placeholders and must be replaced with genuine reviews or the Google Business Profile.
- **About page:** story, team and accreditations.
- **Social links and Google reviews URL:** set once the accounts exist.
- **Legal pages:** `resources/views/legal/` holds template text, which FastTrack should review, ideally with a solicitor.
- **Analytics and ad pixels:** load them only after cookie consent (listen for the `cookies-accepted` browser event).

## Email

`.env.example` uses `MAIL_MAILER=log`, so emails go to `storage/logs/laravel.log` in development. For production, set the `MAIL_*` values for your provider and `FASTTRACK_NOTIFY_EMAIL`, the inbox that receives new-lead alerts.
