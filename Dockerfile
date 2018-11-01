FROM php:7.2-fpm

RUN apt update
RUN apt install -y git
RUN apt install zlib1g-dev
RUN apt install unzip
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql