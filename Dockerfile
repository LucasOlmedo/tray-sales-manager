FROM php:8.2-fpm

ARG UID=1000
ARG GID=1000

RUN groupadd -g $GID docker-user && \
    useradd -u $UID -g docker-user -m docker-user

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

RUN docker-php-ext-install pdo pdo_mysql gd exif pcntl bcmath opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN chown -R docker-user:docker-user /var/www/html
RUN chmod -Rf 777 /var/www/html/storage /var/www/html/bootstrap/cache

USER docker-user

EXPOSE 9000