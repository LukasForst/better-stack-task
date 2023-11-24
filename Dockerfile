# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# obtain composer
COPY --from=composer:2.6 /usr/bin/composer /usr/local/bin/composer

# install deps
RUN apt-get update && apt-get install -y git && \
    docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql && \
    rm -rf /var/lib/apt/lists/*;

# define environment variables for Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/
ENV APACHE_LOG_DIR /var/log/apache2

# configure Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && a2enmod rewrite

WORKDIR /var/www/html/

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist;

COPY . .
RUN composer dump-autoload

EXPOSE 80
CMD ["apache2-foreground"]
