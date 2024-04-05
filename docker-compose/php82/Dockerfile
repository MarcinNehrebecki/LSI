FROM php:8.2-fpm

# see https://github.com/mlocati/docker-php-extension-installer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

# install extensions
RUN install-php-extensions amqp-^1 \
    && install-php-extensions apcu-^5 \
    && install-php-extensions bcmath \
    && install-php-extensions gd \
    && install-php-extensions intl \
    && install-php-extensions memcached-^3.1 \
    && install-php-extensions mongodb-^1 \
    && install-php-extensions pcntl \
    && install-php-extensions pdo_mysql \
    && install-php-extensions redis-^5 \
    && install-php-extensions sockets \
    && install-php-extensions xdebug \
    && install-php-extensions zip \
    \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-enable memcached \
    && docker-php-ext-enable apcu \
    && docker-php-ext-enable redis \
    && docker-php-ext-enable amqp \
    && docker-php-ext-enable mongodb \
    \
    && install-php-extensions @composer-2

RUN install-php-extensions \
            pdo_pgsql opcache calendar xsl

# set timezone
#RUN ln -snf /usr/share/zoneinfo/Europe/Warsaw /etc/localtime && echo Europe/Warsaw > /etc/timezone \
#    && printf '[PHP]\ndate.timezone = "%s"\n', 'Europe/Warsaw' > /usr/local/etc/php/conf.d/tzone.ini

# copy development php.ini
RUN mv $PHP_INI_DIR/php.ini-development /usr/local/etc/php/php.ini

ARG DOCKER_USER_ID
ARG DOCKER_GROUP_ID

RUN addgroup -gid ${DOCKER_GROUP_ID} user && \
    adduser --gecos '' --disabled-password --uid ${DOCKER_USER_ID} --gid ${DOCKER_GROUP_ID} user

RUN set -uex \
    && apt-get update \
    && apt-get install -y ca-certificates curl gnupg \
    && mkdir -p /etc/apt/keyrings \
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key \
     | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && NODE_MAJOR=18 \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_MAJOR.x nodistro main" \
     | tee /etc/apt/sources.list.d/nodesource.list \
    && apt-get update \
    && apt-get install nodejs -y;



WORKDIR /app
