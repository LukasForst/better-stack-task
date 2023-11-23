# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# install deps
RUN docker-php-ext-install mysqli pdo pdo_mysql  \
    && docker-php-ext-enable pdo_mysql

# define environment variables for Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/
ENV APACHE_LOG_DIR /var/log/apache2

# configure Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && a2enmod rewrite

# and now copy data
WORKDIR /var/www/html
COPY . /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
