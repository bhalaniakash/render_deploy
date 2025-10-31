# Simple Dockerfile for deploying this Laravel app on Render using Docker
# This image uses PHP CLI and runs artisan serve. For production consider using nginx+php-fpm.

FROM php:8.2-cli

WORKDIR /var/www/html

# Install system dependencies and PHP extensions (including PostgreSQL)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath pcntl xml opcache \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy composer files first (leverages Docker layer cache)
COPY composer.json composer.lock ./

RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader || true

# Copy the rest of the application
COPY . .

# Ensure storage/framework subdirectories exist and are writable by the web user
RUN mkdir -p storage/framework/views storage/framework/sessions storage/framework/cache bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache || true

# Expose port (Render provides a PORT env var; default to 8000)
EXPOSE 8000

# Use the PORT env var if provided by Render; fall back to 8000
ENV PORT=8000

# Generate optimized autoload files (if composer install ran previously this is okay)
RUN composer dump-autoload --optimize || true

# Use artisan serve for a simple deployment. For production, swap to nginx+php-fpm.
CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
