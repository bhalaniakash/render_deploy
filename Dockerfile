# Stage 1: Composer
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
# Install dependencies without running Composer scripts (scripts may call artisan before app files exist)
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --no-scripts
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
RUN a2enmod rewrite headers && \
    printf '%s\n' \
    "<VirtualHost *:80>" \
    "    ServerAdmin webmaster@localhost" \
    "    DocumentRoot /var/www/html/public" \
    "    DirectoryIndex index.php index.html" \
    "    <Directory /var/www/html/public>" \
    "        Options Indexes FollowSymLinks" \
    "        AllowOverride All" \
    "        Require all granted" \
    "    </Directory>" \
    "    ErrorLog \${APACHE_LOG_DIR}/error.log" \
    "    CustomLog \${APACHE_LOG_DIR}/access.log combined" \
    "</VirtualHost>" \
    > /etc/apache2/sites-available/000-default.conf


RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public || true

WORKDIR /var/www/html
EXPOSE 80
CMD ["apache2-foreground"]
