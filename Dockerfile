FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev zip \
    && docker-php-ext-install pdo_mysql gd zip bcmath

WORKDIR /app
COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

HEALTHCHECK --interval=30s --timeout=10s --start-period=10s CMD curl -f http://localhost:8080 || exit 1

CMD php artisan optimize:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    sleep 5 && \
    php artisan serve --host=0.0.0.0 --port=8080