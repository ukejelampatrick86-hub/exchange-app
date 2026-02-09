FROM php:8.2-cli

# Dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# Extensions PHP
RUN docker-php-ext-install zip pdo pdo_mysql mbstring gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Dossier de travail
WORKDIR /app

# Copier les fichiers
COPY . .

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-interaction

# Port Railway
EXPOSE 8080

# Lancer Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT
