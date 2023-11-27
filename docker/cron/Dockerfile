FROM php:8.2-fpm-alpine

# Postgres Sql drivers
RUN apk add libpq-dev

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

COPY crontab /etc/crontabs/root
RUN mkdir /var/log/cron

CMD ["crond", "-f"]