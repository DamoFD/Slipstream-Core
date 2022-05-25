FROM php:8.0-fpm

RUN apt-get update -y && apt-get upgrade -y
RUN apt-get install -y git \
    ffmpeg  \
	zlib

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql gd curl

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

WORKDIR /var/www
COPY . /var/www

CMD php artisan serve --host=0.0.0.0 --port=8181
EXPOSE 8181