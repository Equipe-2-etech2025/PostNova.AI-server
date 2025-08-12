# Étape de construction
FROM php:8.4.2-fpm as builder

# Configuration des dépôts
RUN echo "deb https://deb.debian.org/debian bookworm main" > /etc/apt/sources.list && \
    echo "deb https://deb.debian.org/debian-security bookworm-security main" >> /etc/apt/sources.list && \
    echo "deb https://deb.debian.org/debian bookworm-updates main" >> /etc/apt/sources.list

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurer l'application
WORKDIR /var/www
COPY . .

# Installer les dépendances (différencie dev/prod)
RUN if [ "$APP_ENV" = "production" ]; then \
    composer install --optimize-autoloader --no-dev; \
    else \
    composer install; \
    fi

# Configurer les permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Étape finale
FROM php:8.4.2-fpm

# Copier depuis le builder
COPY --from=builder /usr/bin/composer /usr/bin/composer
COPY --from=builder /var/www /var/www

# Variables d'environnement
ENV PORT=10000
EXPOSE $PORT

# Commande de démarrage adaptative
CMD ["sh", "-c", "if [ \"$APP_ENV\" = \"production\" ]; then \
    php artisan optimize:clear && \
    php artisan optimize && \
    php artisan serve --host=0.0.0.0 --port=${PORT}; \
    else \
    php artisan serve --host=0.0.0.0 --port=${PORT}; \
    fi"]
