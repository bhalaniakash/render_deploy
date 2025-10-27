### Multi-stage Dockerfile for Laravel (PHP 8.2, Composer vendors, Node asset build)
# - Stage `vendor` installs PHP dependencies with Composer
# - Stage `node` builds frontend assets using Node
# - Final stage runs PHP-FPM and includes vendor + built assets

#############################
# Vendor stage (Composer)
#############################
FROM composer:2 AS vendor
WORKDIR /app

# Copy composer files and install dependencies (no dev)
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --no-scripts

# Copy the rest of the application so autoload and other files are available
COPY . .

# Optimize autoloader
RUN composer dump-autoload --optimize --no-interaction

#############################
# Node stage (build assets)
#############################
FROM node:18-alpine AS node_builder
WORKDIR /app

# Copy only package files, install, then copy rest and build
COPY package*.json ./
# Use npm ci when a lockfile is present for reproducible installs, otherwise fall back to npm install
RUN if [ -f "package-lock.json" ] || [ -f "npm-shrinkwrap.json" ]; then \
            npm ci --silent; \
        else \
            npm install --silent; \
        fi
COPY . .
RUN if [ -f "package.json" ]; then npm run build || npm run production || true; fi

#############################
# Final stage (PHP-FPM)
#############################
FROM php:8.2-apache

# Install system dependencies and PHP extensions commonly needed by Laravel
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    ca-certificates \
    curl \
 && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath zip xml

# Copy composer binary from vendor stage
COPY --from=vendor /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy app files (including vendor) from vendor stage
COPY --from=vendor /app /var/www/html

# Copy built assets (if present)
COPY --from=node_builder /app/public /var/www/html/public

# Ensure Apache serves the Laravel `public` directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf \
    && a2enmod rewrite headers

# Set permissions for storage and cache and public files
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public || true

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr

EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
EXPOSE 10000
CMD ["apache2-foreground"]
