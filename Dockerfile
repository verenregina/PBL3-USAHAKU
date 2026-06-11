FROM php:8.4-fpm-alpine

# Install ekstensi yang dibutuhkan Laravel
RUN apk add --no-cache nginx wget nodejs npm git unzip libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql gd zip opcache

# Ambil Composer terbaru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Bypass pengecekan platform saat install di dalam Docker
RUN composer install --ignore-platform-reqs --no-dev --optimize-autoloader --no-scripts
RUN npm install && npm run build

EXPOSE 80
CMD php artisan serve --host=0.0.0.0 --port=${PORT}