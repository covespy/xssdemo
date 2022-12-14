FROM php:8.1-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev \
    wget nodejs npm \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/app
RUN usermod -u 1000 www-data

RUN --mount=type=secret,id=db-password,required cat /run/secrets/db-password | xargs --replace=INSERTED echo '<?php define("MYSQL_PASSWORD", "INSERTED");' > /etc/db-password.php
