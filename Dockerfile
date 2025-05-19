FROM php:8.2-fpm

# Встановлюємо залежності
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    nano \
    libzip-dev \
    libssl-dev

# Встановлення розширень PHP
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl

# Встановлюємо Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копіюємо проєкт
WORKDIR /var/www
COPY . .

# Встановлюємо залежності Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Даємо права
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

EXPOSE 9000
CMD ["php-fpm"]
