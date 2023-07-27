# docker/php/Dockerfile
FROM php:8.1-fpm

RUN apt-get update
RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN apt-get install -y autoconf pkg-config libssl-dev
RUN pecl install mongodb
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip

# RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
# RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
# RUN php composer-setup.php
# RUN php -r "unlink('composer-setup.php');"
# RUN mv composer.phar /usr/local/bin/composer
# RUN apt-get install -y git
# RUN composer require mongodb/mongodb

CMD php-fpm -F -R
