#!/bin/bash
# Script de build pour Render

echo "Configuration des permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo "Installation des dépendances..."
composer install --no-dev --optimize-autoloader

echo "Nettoyage du cache..."
php artisan cache:clear
php artisan config:cache

echo "Création du lien de stockage..."
php artisan storage:link

echo "Build terminé!"
