FROM wordpress:php8.1-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

COPY custom.ini $PHP_INI_DIR/conf.d/

RUN apt update -y && \
    apt install -y curl && \
    curl -fsSL https://deb.nodesource.com/setup_24.x | bash - && \
    apt install -y nodejs npm libxml2 libxml2-dev && \
    apt clean -y && \
    docker-php-ext-install pdo pdo_mysql soap

WORKDIR /var/www/html/wp-content/plugins/wp-pager

COPY plugin/composer.* .
COPY plugin/package*.json .

# Install all the dependencies and clear cache
RUN composer install --no-interaction --prefer-dist --no-progress && \
    composer clear-cache && \
    npm i

COPY plugin/* .

WORKDIR /var/www/html