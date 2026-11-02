#!/usr/bin/env bash
# Runs on the cPanel server after GitHub Actions has uploaded a new release.
# Safe to run by hand too:  bash ~/fasttrack/deploy/remote-deploy.sh
set -euo pipefail

PHP="${PHP_BIN:-/opt/alt/php83/usr/bin/php}"
APP="$HOME/fasttrack"
WEB="$HOME/public_html"

# Laravel's .htaccess arrives as .htaccess.laravel; keep cPanel's PHP version
# handler block from the live file so the site stays on PHP 8.3.
if [ -f "$WEB/.htaccess.laravel" ]; then
    cp "$WEB/.htaccess.laravel" "$WEB/.htaccess.new"
    if [ -f "$WEB/.htaccess" ]; then
        sed -n '/# php -- BEGIN cPanel-generated handler/,/# php -- END cPanel-generated handler/p' "$WEB/.htaccess" >> "$WEB/.htaccess.new"
    fi
    mv "$WEB/.htaccess.new" "$WEB/.htaccess"
    rm -f "$WEB/.htaccess.laravel"
fi

cd "$APP"
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache

"$PHP" artisan migrate --force
"$PHP" artisan optimize
"$PHP" artisan up

echo "✓ Deployed $(cat "$APP/REVISION" 2>/dev/null || echo 'unknown revision')"
