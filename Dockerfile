FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    unzip zip curl git libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD php artisan serve --host=0.0.0.0 --port=10000