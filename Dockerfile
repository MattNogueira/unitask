FROM php:8.5-fpm

RUN apt-get update && apt-get install -y \
    git curl unzip zip sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www

COPY . .

CMD ["php-fpm"]