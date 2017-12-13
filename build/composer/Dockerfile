FROM php:5.6-alpine

RUN apk --no-cache add curl

RUN curl --silent https://getcomposer.org/installer | php > /dev/null 2>&1 && \
    mv ./composer.phar /usr/local/bin/composer > /dev/null 2>&1

RUN docker-php-ext-install pdo pdo_mysql bcmath

ENTRYPOINT ["composer"]
