FROM php:8.0-apache

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# OS packages
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libpng-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libzip-dev \
    zip \
    git \
    mariadb-client;

# PHP modules
RUN docker-php-ext-install \
    pdo_mysql \
    gd \
    zip \
    && a2enmod \
    rewrite;

#PHP configuration
RUN echo "file_uploads = On\n" \
    "memory_limit = 500M\n" \
    "upload_max_filesize = 500M\n" \
    "post_max_size = 500M\n" \
    "max_execution_time = 600\n" \
    > /usr/local/etc/php/conf.d/uploads.ini

# Apache2 configuration
COPY ./docker-compose/apache2/default.conf /etc/apache2/sites-enabled/000-default.conf

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
