# Image dasar: PHP 8.2 + Apache
FROM php:8.2-apache

# Install dependency OS yang dibutuhkan Laravel + Excel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Aktifkan mod_rewrite untuk Laravel
RUN a2enmod rewrite

# Set DocumentRoot ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy composer dari image resmi
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy seluruh project ke container
COPY . .

# Install dependency Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permission untuk storage & cache
RUN chmod -R 777 storage bootstrap/cache

# Expose port HTTP
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
