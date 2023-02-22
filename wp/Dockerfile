FROM wordpress:php8.2-apache

ENV PATH="./vendor/bin:$PATH"

RUN pecl install xdebug && \
    docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-enable xdebug

COPY xdebug.ini /usr/local/etc/php/conf.d
COPY custom.ini $PHP_INI_DIR/conf.d/

RUN apt-get update -y \
    && apt-get install -y curl libxml2 libxml2-dev \
    && apt-get clean -y \
    && docker-php-ext-install pdo pdo_mysql soap
