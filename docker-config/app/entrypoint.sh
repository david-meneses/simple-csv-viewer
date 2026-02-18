#!/bin/sh
set -e

cd /var/www

if [ ! -f .env ]; then
    cp .env.example .env
fi

if [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction --optimize-autoloader --no-dev
fi

if [ ! -f database/database.sqlite ]; then
    mkdir -p database
    touch database/database.sqlite
fi

# Remove stale package/service manifests that may reference dev-only providers
rm -f bootstrap/cache/packages.php bootstrap/cache/services.php

APP_KEY_VALUE="$(grep '^APP_KEY=' .env | cut -d '=' -f2-)"
if [ -z "$APP_KEY_VALUE" ]; then
    php artisan key:generate --force
fi

php artisan package:discover --ansi
php artisan migrate --force

chown -R www-data:www-data storage bootstrap/cache database || true

exec "$@"
