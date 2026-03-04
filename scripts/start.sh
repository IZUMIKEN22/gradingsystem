#!/bin/bash
echo "========================================"
echo "Starting PHP-FPM..."
php-fpm -D

# Wait a moment for PHP-FPM to start
sleep 3

# Better check: Use 'ps' command instead of pgrep
if ps aux | grep -v grep | grep php-fpm > /dev/null; then
    echo "✅ PHP-FPM started successfully"
else
    echo "❌ ERROR: PHP-FPM failed to start"
    # Still continue to try nginx, but log the error
fi

echo "========================================"
echo "Starting Nginx on port 10000..."
# Create nginx config directory if it doesn't exist
mkdir -p /etc/nginx/sites-available/

# Update Nginx to use port 10000
sed -i 's/listen 80;/listen 10000;/g' /etc/nginx/sites-available/default 2>/dev/null || \
    echo "Warning: Could not update nginx config, but continuing..."

# Test Nginx configuration
nginx -t

# Start Nginx
nginx -g "daemon off;"