FROM php:8.1-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www

# RUN usermod -u 1000 www-data
# RUN setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX /recrutation_task/var/cache
# RUN setfacl -dR -m u:www-data:rwX -m u:`whoami`:rwX /recrutation_task/var/cache
# RUN chown -R www-data:www-data /recrutation_task
# RUN sudo chown -R root:root /recrutation_task/var/cache/*
# COPY ./recrutation_task /recrutation_task
# RUN cd /recrutation_task
# RUN composer install
# RUN mv /recrutation_task /var/www