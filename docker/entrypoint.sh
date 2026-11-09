#!/bin/sh
set -e

cd /var/www/html

if [ ! -f .env ]; then
    cp .env.example .env
fi

if ! grep -q '^APP_KEY=.' .env; then
    php artisan key:generate --force
fi

echo "Waiting for MySQL..."

until php -r '
try {
    new PDO(
        "mysql:host=".getenv("DB_HOST").";dbname=".getenv("DB_DATABASE"),
        getenv("DB_USERNAME"),
        getenv("DB_PASSWORD")
    );
} catch (Throwable $e) {
    exit(1);
}
'; do
    sleep 2
done

echo "MySQL is ready."

php artisan migrate --force
php artisan db:seed --force

chown -R www-data:www-data storage bootstrap/cache

exec apache2-foreground
