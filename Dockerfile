FROM php:8.0
LABEL maintainer="Bobby Hines <bobby@conflabs.com"
LABEL image="wcia/analytes-generator:latest"

# Update repos and install system/security updates
RUN apt-get update && apt-get upgrade -y

# Install required utility programs
RUN apt-get install -y apt-utils \
    build-essential \
    curl \
    nano \
    wget

# Install composer and put binary into $PATH
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install/Enable PHP Zip extension
RUN apt-get install -y libzip-dev zlib1g-dev zip \
    && docker-php-ext-install zip

WORKDIR /srv

VOLUME /srv