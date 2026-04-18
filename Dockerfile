FROM php:8.2-cli

WORKDIR /app

# dépendances système + PostgreSQL
RUN apt-get update && apt-get install -y \
    unzip zip curl git libzip-dev \
    libpq-dev \
    && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# copier projet
COPY . .

# installer dépendances Laravel
RUN composer install --no-dev --optimize-autoloader


CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan serve --host=0.0.0.0 --port=10000