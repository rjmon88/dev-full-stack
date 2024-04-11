FROM php:8.3-apache
#LABEL authors="ramonfarias"

#ENTRYPOINT ["top", "-b"]

# Set the environment variable for the timezone
ENV TZ="America/Sao_Paulo"

## Copy a custom php.ini (optional)
#COPY custom-php.ini /usr/local/etc/php/php.ini

# RUN command to modify php.ini (alternative)
RUN echo "date.timezone = $TZ" >> /usr/local/etc/php/php.ini

# Install the necessary packages
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql
#    && apt-get install -y wget \
#    && apt-get install -y zlib1g-dev \
#    && apt-get install -y zip \
#    && pecl install zip \
#    && docker-php-ext-enable zip \
#    && curl -sS https://getcomposer.org/installer | php --install-dir=/usr/local/bin --filename=composer

# Install Xdebug 3
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Enable Apache modules
RUN a2enmod rewrite

# Copy the app files into the container at /var/www/html
COPY . /var/www/html

# Set the working directory to /var/www/html
WORKDIR /var/www/html
