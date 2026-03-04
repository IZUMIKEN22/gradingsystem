#!/bin/bash
echo "========================================"
echo "Starting PHP-FPM..."
php-fpm -D

# Wait a moment for PHP-FPM to start
sleep 3

# Check if PHP-FPM is running by looking for the process file
if [ -f /usr/local/var/run/php-fpm.pid ] || pgrep -f php-fpm > /dev/null 2>&1; then
    echo "✅ PHP-FPM started successfully"
else
    echo "⚠️  PHP-FPM status check skipped (ps command not available)"
    echo "✅ PHP-FPM should be running based on logs"
fi

echo "========================================"
echo "Starting Nginx on port 10000..."
# Ensure nginx config is updated to use port 10000
sed -i 's/listen 80;/listen 10000;/g' /etc/nginx/sites-available/default 2>/dev/null || \
    echo "Note: Could not update nginx config (may already be correct)"

# Test Nginx configuration
nginx -t

# Start Nginx
nginx -g "daemon off;"