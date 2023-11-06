FROM php:8.1-fpm
ENV COMPOSER_ALLOW_SUPERUSER=1

ARG USER_ID
ARG GROUP_ID
USER $USER_ID:$GROUP_ID

RUN apt-get update && apt-get install -y libxml2-dev libzip-dev librabbitmq-dev libssh-dev git supervisor
RUN docker-php-ext-install pdo pdo_mysql zip bcmath
RUN pecl install amqp
RUN docker-php-ext-enable amqp

RUN mkdir -m a=rwx /data
WORKDIR /data

RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY .docker/php/conf/xdebug-configuration.ini /usr/local/etc/php/conf.d/xdebug-configuration.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY ["composer.lock", "composer.json", "/data/"]

COPY .docker/php/docker-php.ini /usr/local/etc/php/php.ini

RUN mkdir -p /var/log/supervisor
COPY .docker/php/conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ENTRYPOINT []
CMD ["/usr/bin/supervisord"]

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --verbose --prefer-dist --optimize-autoloader --no-progress --no-scripts
