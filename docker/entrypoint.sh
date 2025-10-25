#!/bin/sh
set -e

# Ensure directories exist and ownerships are correct
mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/images/category
chown -R www-data:www-data /var/www/html
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/images || true

# Optionally run artisan commands on startup (uncomment if you want)
# php artisan migrate --force

# Start php-fpm (background) and nginx (foreground)
php-fpm -D || php-fpm
nginx -g 'daemon off;'