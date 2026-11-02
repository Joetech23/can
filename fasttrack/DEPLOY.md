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
/opt/alt/php83/usr/bin/php -v           # the website's PHP (cPanel "Select PHP Version"); plain `php` on this server is 7.4
/opt/alt/php83/usr/bin/php artisan key:generate --force
/opt/alt/php83/usr/bin/php artisan migrate --force
/opt/alt/php83/usr/bin/php artisan fasttrack:admin info@fstremoval.co.uk "FastTrack Office"   # asks for a password (12+ chars)
/opt/alt/php83/usr/bin/php artisan optimize
```

In cPanel → *Select PHP Version → Extensions*, make sure `pdo_sqlite`/`pdo_mysql`, `mbstring`, `intl`, `fileinfo` and `curl` are ticked for the website's PHP.

Do **not** run `db:seed` in production; it creates demo data and a demo login.

## 5. Check it works

- `https://fstremoval.co.uk` loads with the FastTrack branding.
- `/quote` shows a price with mileage (the server must be able to reach `api.postcodes.io`).
- Submit a test quote: the office inbox gets an alert, the customer gets a confirmation, and the quote appears in `/admin`.
- `/track` finds the test quote by reference and postcode.
- `/sitemap.xml` and `/robots.txt` show `https://fstremoval.co.uk` URLs.

Then delete the test quote, and submit the sitemap in Google Search Console (proposal phase 3).

## Automatic deploys from GitHub

Every push to `main` runs `.github/workflows/deploy.yml`:

1. **Test:** installs everything, builds the assets and runs the full test suite. A failing test stops the deploy.
2. **Build:** produces the same package as `deploy/build-cpanel.sh`.
3. **Deploy over SSH:** maintenance mode on → upload the app to `~/fasttrack` and the public files to `~/public_html` → `deploy/remote-deploy.sh` runs migrations and caches and brings the site back up.

The server's `.env`, database, logs and sessions are never uploaded or deleted. In `public_html` only `build/` is mirrored, so `.well-known`, `cgi-bin`, `php.ini` and any verification files stay. cPanel's PHP 8.3 handler in `.htaccess` is kept. If a deploy fails partway, the last step takes the site out of maintenance mode.

Pull requests run the tests only. Use *Actions → Test & deploy → Run workflow* to redeploy without a code change.

### One-time setup

**1. Create a deploy key on the server.** In cPanel → *Terminal*:

```bash
ssh-keygen -t ed25519 -f ~/.ssh/github_deploy -N "" -C "github-deploy"
cat ~/.ssh/github_deploy.pub >> ~/.ssh/authorized_keys && chmod 600 ~/.ssh/authorized_keys
cat ~/.ssh/github_deploy
```

Copy the whole private key that the last command prints, from `-----BEGIN` to `END-----`. Then delete it from the server:

```bash
rm ~/.ssh/github_deploy
```

**2. Find the SSH port.** It's shown in cPanel → *SSH Access*, or ask the host. It is often `22`; some hosts use a custom port.

**3. Add secrets in GitHub.** Go to the repo → *Settings → Secrets and variables → Actions → New repository secret*:

| Secret | Value |
|---|---|
| `SSH_HOST` | `cp165173.hpdns.net` |
| `SSH_USER` | `fstremov` |
| `SSH_PORT` | the SSH port (leave out if 22) |
| `SSH_KEY` | the private key from step 1 |

Optional *variable* (same page, Variables tab): `PHP_BIN`, if the server's PHP 8.3 path is not `/opt/alt/php83/usr/bin/php`.

**4. Protect production (optional).** *Settings → Environments → production* → add yourself as a required reviewer if you want to approve each deploy.

### Day-to-day

```bash
git checkout -b my-change      # work on a branch
git push -u origin my-change   # open a pull request; tests run automatically
# merge the pull request into main → it deploys
```

### Deploying by hand

If GitHub Actions is unavailable, build the zip with `deploy/build-cpanel.sh`, upload it and extract it in the home folder. Then copy the new `public_html` contents into place and run:

```bash
bash ~/fasttrack/deploy/remote-deploy.sh
```

## Troubleshooting

- **500 error:** check `fasttrack/storage/logs/` for the latest log. Usually a wrong DB password in `.env`, or the PHP version is below 8.3.
- **Unstyled page:** `public_html/build/` is missing. Re-extract the zip.
- **Changes to `.env` not showing:** run `php artisan config:cache` again.
