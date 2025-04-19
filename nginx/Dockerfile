# Основной вариант (с повтором при ошибке)
ARG NGINX_VERSION=1.23-alpine
FROM nginx:${NGINX_VERSION}

# Альтернативные варианты (раскомментируйте при ошибке):
# FROM ghcr.io/nginx:1.23-alpine
# FROM docker.io/bitnami/nginx:1.23

# Удаляем дефолтный конфиг
RUN rm /etc/nginx/conf.d/default.conf

# Копируем наш конфиг
COPY nginx.conf /etc/nginx/conf.d/bitrix.conf

# Создаем директорию приложения
RUN mkdir -p /var/www/bitrix && \
    chown -R nginx:nginx /var/www/bitrix

WORKDIR /var/www/bitrix

# Добавляем healthcheck
HEALTHCHECK --interval=30s --timeout=3s \
    CMD curl -f http://localhost/ || exit 1