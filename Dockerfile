# Étape de construction
FROM php:8.4.2-fpm as builder

# 1. Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libpq-dev zip unzip \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# 3. Configurer l'application
WORKDIR /var/www
COPY . .

# 4. Créer les répertoires avec les bonnes permissions AVANT l'installation des dépendances
RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# 5. Installer les dépendances avec le bon utilisateur
USER www-data
RUN if [ "$APP_ENV" = "production" ]; then \
    composer install --optimize-autoloader --no-dev --no-interaction; \
    else \
    composer install --no-interaction; \
    fi

# Étape finale
FROM webdevops/php:8.2-alpine

# Copier depuis le builder
COPY --from=builder --chown=www-data:www-data /var/www /var/www

# Variables d'environnement
ENV PORT=10000
EXPOSE $PORT

# Configurer les permissions finales
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

WORKDIR /var/www

# Commande optimisée avec configuration des permissions
CMD sh -c "php artisan storage:link && \
           php artisan optimize && \
           php artisan serve --host=0.0.0.0 --port=${PORT}"
