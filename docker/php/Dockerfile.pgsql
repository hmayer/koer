FROM php:7.4-fpm-alpine
RUN apk add $PHPIZE_DEPS zlib-dev libpng-dev postgresql-dev && \
	pecl install xdebug

RUN docker-php-ext-install gd pdo pdo_pgsql
