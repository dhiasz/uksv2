# Base image PHP 8.2 dengan tools dasar
FROM php:8.2-fpm

# Install dependencies OS
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

# Copy composer dari image resmi composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy seluruh project ke dalam container
COPY . .

# Install dependensi Laravel (di container, bukan host)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permission storage & bootstrap cache
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
