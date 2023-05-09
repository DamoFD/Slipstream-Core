FROM serversideup/php:8.0-fpm-nginx

# Set environment variables
ENV SSL_MODE="off"
ENV PHP_OPEN_BASEDIR="$WEBUSER_HOME:/dev/stdout:/tmp:/usr/bin"

ENV FFMPEG_BINARIES="/usr/bin/ffmpeg"
ENV FFPROBE_BINARIES="/usr/bin/ffprobe"


# TODO: git, supervisor?
RUN apt-get update && apt-get install -y \
    ffmpeg \
    \
# Clean up
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Copy S6 configs
COPY --chmod=755 deploy/s6-overlay/ /etc/s6-overlay/

COPY  --chown=9999:9999 ./../ /var/www/html

#RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN composer install --no-interaction --optimize-autoloader

EXPOSE 80

CMD ["su", "webuser", "-c", "php artisan queue:work --tries=3"]
