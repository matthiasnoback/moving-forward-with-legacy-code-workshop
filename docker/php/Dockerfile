FROM php:8.0-cli-alpine

COPY php.ini ${PHP_INI_DIR}
ENTRYPOINT ["php"]

RUN apk add icu-dev \
    && docker-php-ext-install intl
