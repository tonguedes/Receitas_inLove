# Imagem base do PHP com Apache
FROM php:8.2-apache

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libpq-dev libzip-dev && \
    docker-php-ext-install pdo pdo_pgsql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar arquivos para o container
COPY . /var/www/html

# Set permissões
WORKDIR /var/www/html
RUN chmod -R 775 storage bootstrap/cache

# Permitir o uso de plugins Composer como root (solução prática)
ENV COMPOSER_ALLOW_SUPERUSER=1

# Instalar dependências Laravel
RUN composer install --no-dev --optimize-autoloader && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Porta do Apache
EXPOSE 80

# Comando para iniciar o Apache (ajustado corretamente)
CMD ["apache2-foreground"]
