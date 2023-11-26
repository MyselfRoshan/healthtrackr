FROM php:8.1-fpm-alpine

# RUN docker-php-ext-install pdo pdo_pgsql pgsql
# RUN docker-php-ext-install pdo pdo_pgsql pgsql

COPY crontab /etc/crontabs/root
RUN mkdir /var/log/crontab

CMD ["crond", "-f"]