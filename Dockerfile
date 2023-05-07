FROM serversideup/php:8.0-fpm-nginx

# Set environment variables
ENV SSL_MODE="off"
ENV PHP_OPEN_BASEDIR="/var/www/html:/dev/stdout:/tmp:/usr/bin"

ENV FFMPEG_BINARIES="/usr/bin/ffmpeg"
ENV FFPROBE_BINARIES="/usr/bin/ffprobe"


# TODO: git, supervisor?
RUN apt-get update && apt-get install -y \
    ffmpeg \
    \
# Clean up
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY  --chown=9999:9999 ./../ /var/www/html

#RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN composer install --no-interaction --optimize-autoloader

EXPOSE 80
