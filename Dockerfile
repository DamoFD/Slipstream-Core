FROM serversideup/php:8.0-fpm-nginx


# TODO: git, supervisor?
RUN apt-get update && apt-get install -y \
    ffmpeg

COPY  --chown=9999:9999 ./../ /var/www/html

#RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN composer install --no-interaction --optimize-autoloader

EXPOSE 80
