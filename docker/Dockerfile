FROM php:8.0-fpm

RUN apt-get update && apt-get install -y git libzip-dev \
  && docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
