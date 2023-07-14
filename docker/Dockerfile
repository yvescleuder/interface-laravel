FROM php:8.1-fpm

# Arguments defined in docker-compose.yml
ARG USER
ARG UID
ARG NEWRELIC_KEY
ARG NEWRELIC_APP_NAME
ARG NEWRELIC_DAEMON_ADDRESS

ENV USER=$USER
ENV UID=$UID
ENV NEWRELIC_KEY=$NEWRELIC_KEY
ENV NEWRELIC_APP_NAME=$NEWRELIC_APP_NAME
ENV NEWRELIC_DAEMON_ADDRESS=$NEWRELIC_DAEMON_ADDRESS

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    htop \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    poppler-utils \
    && docker-php-ext-install zip \
    && apt -y autoremove

# Install nodejs
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

RUN docker-php-ext-install opcache
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $UID -d /home/$USER $USER
RUN mkdir -p /home/$USER/.composer && \
    chown -R $USER:$USER /home/$USER

# Set working directory
WORKDIR /var/www

USER $USER
