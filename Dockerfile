FROM php:8.0-apache
WORKDIR /var/www/html
RUN apt-get update -y
RUN docker-php-ext-install pdo_mysql