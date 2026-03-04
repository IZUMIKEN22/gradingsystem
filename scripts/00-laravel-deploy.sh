#!/usr/bin/env bash
echo "Starting deployment..."

# Set PHP timeout values
echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/timeout.ini
echo "max_input_time = 300" >> /usr/local/etc/php/conf.d/timeout.ini
echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/timeout.ini

echo "Running composer..."
composer install --no-dev --optimize-autoloader

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force

echo "Setting permissions..."
chmod -R 777 storage
chmod -R 777 bootstrap/cache

echo "Optimizing Laravel..."
php artisan optimize

# --- CRITICAL PART: Start Services ---
echo "Starting PHP-FPM..."
php-fpm -D

# Check if PHP-FPM started
if pgrep -x "php-fpm" > /dev/null; then
    echo "PHP-FPM started successfully."
else
    echo "ERROR: PHP-FPM failed to start"
    exit 1
fi

echo "Starting Nginx..."
# Replace the default nginx port with the $PORT variable in the config
sed -i "s/80/${PORT:-80}/g" /etc/nginx/sites-available/default
# Start Nginx in the foreground (this keeps the container running)
nginx -g "daemon off;"