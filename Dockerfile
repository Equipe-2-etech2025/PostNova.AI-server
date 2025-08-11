FROM php:8.4.2-fpm

# Configuration des dépôts et certificats
RUN echo "deb https://deb.debian.org/debian bookworm main" > /etc/apt/sources.list && \
    echo "deb https://deb.debian.org/debian-security bookworm-security main" >> /etc/apt/sources.list && \
    echo "deb https://deb.debian.org/debian bookworm-updates main" >> /etc/apt/sources.list

RUN apt-get update && \
    apt-get install -y --no-install-recommends ca-certificates && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Installation des dépendances
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Extensions PHP
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Structure du projet
RUN mkdir -p /var/www/bootstrap/cache /var/www/storage/framework/{sessions,views,cache}
WORKDIR /var/www

# Installation des dépendances
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-interaction

# Copie des fichiers de l'application
COPY . .

# Configuration des permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/bootstrap/cache /var/www/storage

# Optimisation de l'autoload
RUN composer dump-autoload --optimize

# Configuration pour Render
ENV PORT=10000
EXPOSE 10000

# Commande unique pour tous les environnements
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=${PORT}"]
