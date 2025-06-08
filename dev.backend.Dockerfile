FROM php:8.3.20-bullseye

RUN apt-get update && apt-get install -y \
        curl \ 
        libpq-dev \
        git \
        unzip
RUN docker-php-ext-install pdo pdo_pgsql

COPY . /app
WORKDIR /app

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
        && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
        && rm composer-setup.php

RUN composer install

CMD [ "php", "-S", "0.0.0.0:10302", "-t", "public" ]