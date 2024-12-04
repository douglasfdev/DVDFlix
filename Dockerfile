FROM php:8.3-apache

WORKDIR /usr/www/html

EXPOSE 8000

# Mod rewrite
RUN a2enmod rewrite

RUN apt-get update -y && apt-get install -y libicu-dev libpq-dev unzip zip lsof

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install gettext intl pdo_pgsql
COPY .env.example /usr/www/html/.env

EXPOSE 8000

CMD [ "php", "artisan", "serve" ]