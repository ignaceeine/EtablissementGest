FROM php:8.2-fpm

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie du code de l'application
WORKDIR /var/www/html
COPY . .

# Installation des dépendances PHP
RUN composer install --no-progress --prefer-dist --optimize-autoloader

# Configuration des permissions
RUN chown -R www-data:www-data /var/www/html

# Exposition du port
EXPOSE 9000

# Commande par défaut
CMD ["php-fpm"]
