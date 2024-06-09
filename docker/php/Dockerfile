FROM php:8.2-cli-alpine

RUN apk add icu-dev \
    && docker-php-ext-install intl

ENTRYPOINT ["php"]

COPY php.ini ${PHP_INI_DIR}
