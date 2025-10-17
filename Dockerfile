FROM php:8.2-cli

# Install dependencies Laravel
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev zip sqlite3 \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite gd zip bcmath

WORKDIR /app

COPY . .

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Buat file SQLite kosong biar gak error
RUN mkdir -p /app/database && touch /app/database/database.sqlite

# Fix permission
RUN chmod -R 777 /app/storage /app/bootstrap/cache /app/database

EXPOSE 8080

# Jalankan Laravel
CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    sleep 3 && \
    php artisan serve --host=0.0.0.0 --port=8080