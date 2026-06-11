FROM php:8.5-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# RUN php artisan config:cache
# RUN php artisan route:cache
# RUN php artisan view:cache

CMD ["php-fpm"]