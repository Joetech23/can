# Deploying to cPanel

FastTrack's hosting is cPanel at `cp165173.hpdns.net` (username `fstremov`), domain `fstremoval.co.uk`.

The app runs from `/home/fstremov/fasttrack`, outside the web root, so `.env`, logs and code are never downloadable. Only the `public_html` folder is served.

## 1. Build the package

On any machine with PHP 8.3+, Composer and Node 22:

```bash
cd fasttrack
deploy/build-cpanel.sh          # → deploy/dist/fasttrack-cpanel.zip
```

The zip contains two folders: `fasttrack/` (the app) and `public_html/` (the web root).

## 2. One-time cPanel setup

1. **PHP version:** cPanel → *MultiPHP Manager* → set `fstremoval.co.uk` to **PHP 8.3** or newer. In *Select PHP Version → Extensions*, make sure these are ticked: `pdo_mysql`, `mbstring`, `openssl`, `curl`, `fileinfo`, `bcmath`, `intl`, `xml`, `ctype`, `tokenizer`.
2. **Database:** cPanel → *MySQL Database Wizard*. Create database `fasttrack` and user `app` (cPanel prefixes both, giving `fstremov_fasttrack` and `fstremov_app`), with **All privileges**.
3. **Email:** cPanel → *Email Accounts*: create `info@fstremoval.co.uk` if it doesn't exist. The site sends quote emails through it.
4. **SSL:** cPanel → *SSL/TLS Status* → run AutoSSL for the domain, then *Domains* → turn on **Force HTTPS Redirect**.

## 3. Upload

1. cPanel → *File Manager* → open `public_html` and **back up anything already there** (select all → Compress), then delete the old contents.
2. Go to the home folder (`/home/fstremov`), **Upload** `fasttrack-cpanel.zip`, then right-click → **Extract**. This creates `fasttrack/` and fills `public_html/`.
3. In `fasttrack/`, copy `.env.example` to `.env` and edit it: set the database password, the email password and FastTrack's phone/WhatsApp numbers.

## 4. Finish in the cPanel Terminal

cPanel → *Terminal* (if it's missing, ask the host to enable shell access):

```bash
cd ~/fasttrack
php -v                                  # must show 8.3+; otherwise use /opt/cpanel/ea-php83/root/usr/bin/php
php artisan key:generate --force
php artisan migrate --force
php artisan fasttrack:admin info@fstremoval.co.uk "FastTrack Office"   # asks for a password (12+ chars)
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

Do **not** run `db:seed` in production; it creates demo data and a demo login.

## 5. Check it works

- `https://fstremoval.co.uk` loads with the FastTrack branding.
- `/quote` shows a price with mileage (the server must be able to reach `api.postcodes.io`).
- Submit a test quote: the office inbox gets an alert, the customer gets a confirmation, and the quote appears in `/admin`.
- `/track` finds the test quote by reference and postcode.
- `/sitemap.xml` and `/robots.txt` show `https://fstremoval.co.uk` URLs.

Then delete the test quote, and submit the sitemap in Google Search Console (proposal phase 3).

## Updating later

Build a new zip and upload and extract it over the old files (your `.env` is not in the zip, so it is kept). Then run:

```bash
cd ~/fasttrack
php artisan migrate --force
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

## Troubleshooting

- **500 error:** check `fasttrack/storage/logs/` for the latest log. Usually a wrong DB password in `.env`, or the PHP version is below 8.3.
- **Unstyled page:** `public_html/build/` is missing. Re-extract the zip.
- **Changes to `.env` not showing:** run `php artisan config:cache` again.
