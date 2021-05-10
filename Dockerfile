FROM php:8.0
ADD . /var/www
WORKDIR /var/www/

RUN apt-get update && apt-get upgrade -y \
    && apt-get install apt-utils -y \
    && apt-get install wget curl git zip libzip-dev libmcrypt-dev libgmp-dev libffi-dev libssl-dev libpq-dev libxslt-dev -y \
    && yes | pecl install -f xdebug \
    && docker-php-ext-enable xdebug  \
    && docker-php-ext-install -j$(nproc) intl zip pdo pdo_pgsql pgsql xsl

COPY ./docker.d/php.d/*.ini /usr/local/etc/php/conf.d/

RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

