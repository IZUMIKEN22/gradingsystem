#!/bin/bash
echo "Starting PHP-FPM..."
php-fpm -D

# Check if PHP-FPM is running
if ! pgrep -x "php-fpm" > /dev/null; then
    echo "ERROR: PHP-FPM failed to start"
    exit 1
fi
echo "PHP-FPM started successfully"

echo "Starting Nginx on port 10000..."
# Update Nginx to use port 10000
sed -i 's/listen 80;/listen 10000;/g' /etc/nginx/sites-available/default

# Test Nginx configuration
nginx -t

# Start Nginx
nginx -g "daemon off;"