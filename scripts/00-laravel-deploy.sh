#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

# Set memory limit for PHP CLI
echo "memory_limit = 256M" > /usr/local/etc/php/conf.d/memory-limit.ini