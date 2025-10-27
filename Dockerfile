# Stage 1: Composer
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress
COPY . .
RUN composer dump-autoload --optimize

# Stage 2: Node (optional)
FROM node:18-alpine AS node_builder
WORKDIR /app
COPY package*.json ./
RUN npm install --silent
COPY . .
RUN npm run build || npm run production || true

# Stage 3: PHP + Apache
FROM php:8.2-apache
RUN apt-get update && apt-get install -y git unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath zip xml \
    && rm -rf /var/lib/apt/lists/*

COPY --from=vendor /app /var/www/html
COPY --from=node_builder /app/public /var/www/html/public

RUN a2enmod rewrite headers
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

WORKDIR /var/www/html
EXPOSE 80
CMD ["apache2-foreground"]
