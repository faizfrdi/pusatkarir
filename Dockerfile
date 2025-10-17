# Gunakan base image PHP
FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip libpng-dev libonig-dev && \
    docker-php-ext-install pdo pdo_mysql zip gd

# Set working directory
WORKDIR /app

# Copy project ke container
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permission
RUN chmod -R 775 storage bootstrap/cache

# Expose port Railway (8080)
EXPOSE 8080

# Jalankan Laravel di port 8080
CMD php artisan serve --host 0.0.0.0 --port 8080