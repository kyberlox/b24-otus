FROM php:8.2.8-fpm-bookworm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    supervisor \
    cron \
    gnupg \
    wget \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mysqli \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        sockets \
        zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка Bitrix
RUN mkdir -p /var/www/bitrix
RUN wget -O /var/www/bitrix/bitrixsetup.php https://www.1c-bitrix.ru/download/scripts/bitrixsetup.php \
    && wget -O /var/www/bitrix/restore.php https://www.1c-bitrix.ru/download/scripts/restore.php

# Настройка PHP
COPY php.ini /usr/local/etc/php/conf.d/custom.ini
COPY www.conf /usr/local/etc/php-fpm.d/www.conf
COPY supervisor.conf /etc/supervisor/conf.d/supervisor.conf

# Настройка cron для Bitrix
RUN echo "* * * * * www-data /usr/local/bin/php /var/www/bitrix/bitrix/modules/main/tools/cron_events.php" >> /etc/crontab

WORKDIR /var/www/bitrix

# Создаем группу www и добавляем в нее пользователя www-data
RUN groupadd -g 1000 www && \
    usermod -a -G www www-data && \
    chown -R www-data:www /var/www && \
    chmod -R 777 /var/www

# Настройка прав для Bitrix
RUN mkdir -p /var/www/upload && \
    mkdir -p /var/www/bitrix/backup && \
    mkdir -p /var/www/bitrix/cache && \
    mkdir -p /var/www/managed_cache && \
    mkdir -p /var/www/bitrix/stack_cache && \
    mkdir -p /var/www/bitrix/html_pages && \
    mkdir -p /var/www/bitrix/tmp && \
    chown -R www-data:www /var/www/html && \
    chmod -R 777 /var/www/html

CMD ["supervisord", "-n"]