FROM php:8.2-fpm

# Install Nginx and dependencies - ADDED PostgreSQL extensions
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && docker-php-ext-install pdo_pgsql pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Copy Nginx configuration
COPY ./conf/nginx/nginx-site.conf /etc/nginx/sites-available/default

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader || \
    composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-zip

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Expose port 10000 (Render's default)
EXPOSE 10000

# Copy and set permissions for start script
COPY ./scripts/start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]