#!/usr/bin/env bash
# Builds an upload-ready package for cPanel shared hosting.
#
#   deploy/build-cpanel.sh [output-dir]
#
# Produces fasttrack-cpanel.zip containing:
#   fasttrack/     the Laravel app → upload to /home/<cpanel-user>/fasttrack (outside the web root)
#   public_html/   the web root    → upload into /home/<cpanel-user>/public_html
set -euo pipefail

APP_DIR="$(cd "$(dirname "$0")/.." && pwd)"
OUT_DIR="${1:-$APP_DIR/deploy/dist}"
STAGE="$(mktemp -d)"
trap 'rm -rf "$STAGE"' EXIT

echo "→ Building front-end assets"
(cd "$APP_DIR" && npm ci --no-audit --no-fund >/dev/null && npm run build >/dev/null)

echo "→ Copying application"
mkdir -p "$STAGE/fasttrack"
tar -C "$APP_DIR" -cf - \
    --exclude=./node_modules --exclude=.git --exclude=./tests --exclude=./deploy/dist \
    --exclude=./.env --exclude='./database/*.sqlite' --exclude=./public/hot \
    --exclude='./storage/logs/*.log' --exclude='./storage/framework/sessions/*' \
    --exclude='./storage/framework/views/*.php' --exclude='./storage/framework/cache/data/*' \
    --exclude='./bootstrap/cache/*.php' --exclude=./.phpunit.result.cache . \
    | tar -C "$STAGE/fasttrack" -xf -

echo "→ Installing production PHP dependencies"
(cd "$STAGE/fasttrack" && composer install --no-dev --optimize-autoloader --no-interaction --no-progress --quiet)
# Packages installed from source carry their git history; it is not needed on the server.
find "$STAGE/fasttrack/vendor" -name .git -type d -prune -exec rm -rf {} +

echo "→ Preparing public_html"
mv "$STAGE/fasttrack/public" "$STAGE/public_html"
# The app lives one level up in ../fasttrack; tell Laravel where its public folder is.
sed -i \
    -e "s#__DIR__.'/../storage/#__DIR__.'/../fasttrack/storage/#" \
    -e "s#__DIR__.'/../vendor/#__DIR__.'/../fasttrack/vendor/#" \
    -e "s#__DIR__.'/../bootstrap/#__DIR__.'/../fasttrack/bootstrap/#" \
    -e "s#^\$app->handleRequest#\$app->usePublicPath(__DIR__);\n\$app->handleRequest#" \
    "$STAGE/public_html/index.php"
grep -q "fasttrack/vendor/autoload.php" "$STAGE/public_html/index.php" || { echo "index.php patch failed" >&2; exit 1; }
grep -q "usePublicPath" "$STAGE/public_html/index.php" || { echo "index.php patch failed" >&2; exit 1; }

cp "$APP_DIR/deploy/.env.production.example" "$STAGE/fasttrack/.env.example"

echo "→ Zipping"
mkdir -p "$OUT_DIR"
rm -f "$OUT_DIR/fasttrack-cpanel.zip"
(cd "$STAGE" && zip -qr "$OUT_DIR/fasttrack-cpanel.zip" fasttrack public_html)
echo "✓ $(du -h "$OUT_DIR/fasttrack-cpanel.zip" | cut -f1) → $OUT_DIR/fasttrack-cpanel.zip"
