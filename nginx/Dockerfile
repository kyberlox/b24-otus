FROM nnginx:latest

RUN rm /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/conf.d/bitrix.conf

WORKDIR /var/www/bitrix