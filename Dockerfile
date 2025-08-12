# Étape de construction
FROM php:8.4.2-fpm as builder

# 1. Créez d'abord les répertoires avec les bonnes permissions
RUN mkdir -p /var/www/bootstrap/cache /var/www/storage/framework/{sessions,views,cache} \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/bootstrap/cache /var/www/storage

# 2. Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libpq-dev zip unzip \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 3. Installer Composer (en tant qu'utilisateur non-root)
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# 4. Configurer l'application
WORKDIR /var/www
COPY . .

# 5. Installer les dépendances avec le bon utilisateur
USER www-data
RUN if [ "$APP_ENV" = "production" ]; then \
    composer install --optimize-autoloader --no-dev --no-interaction; \
    else \
    composer install --no-interaction; \
    fi

# Étape finale
FROM php:8.4.2-fpm

# Copier depuis le builder
COPY --from=builder --chown=www-data:www-data /var/www /var/www
COPY --from=builder /usr/local/bin/composer /usr/local/bin/composer

# Variables d'environnement
ENV PORT=10000
EXPOSE $PORT

# Configurez le répertoire de travail une seconde fois avant CMD
WORKDIR /var/www

# Commande optimisée pour Render
CMD ["sh", "-c", "php artisan optimize && php artisan serve --host=0.0.0.0 --port=${PORT}"]
