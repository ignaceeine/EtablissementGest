FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    postgresql-dev \
    libpng-dev \
    libzip-dev \  # Added for ZIP support
    zip \
    unzip \
    supervisor

# Install PHP extensions
# Make sure libzip-dev is installed before installing the zip extension
RUN docker-php-ext-install pdo pdo_pgsql pgsql zip gd

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-dev --no-scripts --no-progress --prefer-dist --optimize-autoloader

# Copy the rest of the application
COPY . .

# Run post-install scripts
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start supervisor (if you have supervisor configured)
CMD ["php-fpm"]
