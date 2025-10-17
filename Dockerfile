# Gunakan PHP CLI
FROM php:8.2-cli

# Install dependency Laravel
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev zip \
    && docker-php-ext-install pdo_mysql gd zip bcmath

# Set working dir
WORKDIR /app

# Copy semua file
COPY . .

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Buat direktori penting (biar gak missing pas container start)
RUN mkdir -p /app/storage/framework/{cache,sessions,views} && \
    mkdir -p /app/bootstrap/cache && \
    chmod -R 777 /app/storage /app/bootstrap/cache

# Expose port Railway
EXPOSE 8080

# Jalankan Laravel
CMD php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan cache:clear && \
    sleep 3 && \
    php artisan serve --host=0.0.0.0 --port=8080