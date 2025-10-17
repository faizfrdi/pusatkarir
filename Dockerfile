# Gunakan base image PHP
FROM php:8.2-apache

# Install extension dan utilitas yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip libpng-dev libonig-dev && \
    docker-php-ext-install pdo pdo_mysql zip gd

# Copy project ke dalam container
WORKDIR /var/www/html
COPY . .

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Generate app key kalau belum ada (Render juga bisa pakai env)
RUN php artisan key:generate --force || true

# Aktifkan mod_rewrite untuk Laravel
RUN a2enmod rewrite
RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
</Directory>" >> /etc/apache2/apache2.conf

# Set working directory ke public
WORKDIR /var/www/html/public

# Ekspos port default
EXPOSE 8080

# Jalankan Apache
CMD ["apache2-foreground"]