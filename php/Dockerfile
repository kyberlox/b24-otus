FROM php:7.4-fpm

# Установка необходимых пакетов
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql zip mysqli \
    && pecl install redis \
    && docker-php-ext-enable redis

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Настройка PHP
COPY php.ini /usr/local/etc/php/conf.d/custom.ini
COPY php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Создание необходимых директорий
RUN mkdir -p /var/www/html \
    && mkdir -p /var/log/php \
    && chown -R www-data:www-data /var/www/html \
    && chown -R www-data:www-data /var/log/php \
    && chmod -R 755 /var/www/html \
    && chmod -R 755 /var/log/php

# Установка рабочей директории
WORKDIR /var/www/html

# Установка прав на файлы
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Запуск PHP-FPM
CMD ["php-fpm"] 