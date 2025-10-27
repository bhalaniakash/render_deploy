# =======================================================
# 🐘 Laravel + Apache Production Dockerfile (PHP 8.2)
# Works perfectly with Render free tier
# =======================================================

# Use official PHP-Apache image
FROM php:8.2-apache

# Install system dependencies and PHP extensions needed for Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    ca-certificates \
    curl \
 && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath zip xml \
 && a2enmod rewrite headers \
 && rm -rf /var/lib/apt/lists/*

# Copy Composer from the Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy all Laravel project files into container
COPY . .

# ✅ Set Apache document root to /public (Laravel’s front controller)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# ✅ Install Composer dependencies (production only)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# ✅ Set folder permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 755 /var/www/html

# ✅ Optional: Health check (helps Render detect if container is alive)
HEALTHCHECK --interval=30s --timeout=10s CMD curl -f http://localhost/ || exit 1

# Expose Apache’s port
EXPOSE 80

# Set environment defaults
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Start Apache in the foreground
CMD ["apache2-foreground"]
