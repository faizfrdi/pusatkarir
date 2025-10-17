# Gunakan image PHP CLI
FROM php:8.2-cli

# Install dependencies Laravel
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev libzip-dev zip curl \
    && docker-php-ext-install pdo_mysql gd zip bcmath

# Set working directory
WORKDIR /app

# Copy semua file project
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permission biar storage dan cache bisa dipakai
RUN chmod -R 775 storage bootstrap/cache

# Expose port untuk Railway
EXPOSE 8080

# Tambah healthcheck biar Railway yakin app-nya hidup
HEALTHCHECK --interval=30s --timeout=10s --start-period=10s CMD curl -f http://localhost:8080 || exit 1

# Jalankan Laravel
CMD sleep 5 && php artisan serve --host=0.0.0.0 --port=8080