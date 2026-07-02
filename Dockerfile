FROM wordpress:php8.1-apache

COPY custom.ini $PHP_INI_DIR/conf.d/

RUN apt update -y && \
    apt install -y curl && \
    curl -fsSL https://deb.nodesource.com/setup_24.x | bash - && \
    apt install -y \
        nodejs \
        libxml2 \
        libxml2-dev \
        unzip && \
    apt clean -y && \
    docker-php-ext-install pdo pdo_mysql soap && \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
