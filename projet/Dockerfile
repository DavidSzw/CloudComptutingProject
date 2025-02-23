# Utiliser l'image officielle PHP avec FPM
FROM php:7.4-fpm

# Copier les fichiers du site dans le répertoire par défaut de PHP-FPM
COPY ./site /var/www/html/

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Permissions pour les fichiers
RUN chown -R www-data:www-data /var/www/html
