FROM wordpress:php8.1-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY custom.ini $PHP_INI_DIR/conf.d/

RUN apt-get update -y \
    && apt-get install -y curl libxml2 libxml2-dev \
    && apt-get clean -y \
    && docker-php-ext-install pdo pdo_mysql soap
