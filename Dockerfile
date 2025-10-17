# Gunakan PHP CLI, bukan Apache
FROM php:8.2-cli

# Install dependency Laravel
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev libzip-dev zip \
    && docker-php-ext-install pdo_mysql gd zip bcmath

# Set working directory
WORKDIR /app

# Copy semua file Laravel
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permission untuk storage & cache
RUN chmod -R 775 storage bootstrap/cache

# Expose port Railway
EXPOSE 8080

# Jalankan Laravel pakai artisan serve
CMD php artisan serve --host=0.0.0.0 --port=8080