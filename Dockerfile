FROM php:8.2-apache

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libpq-dev libzip-dev && \
    docker-php-ext-install pdo pdo_pgsql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos para o container
COPY . .

# Copiar e preparar .env
COPY .env.example .env


RUN php artisan key:generate

# Corrigir permissões
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache

# Permitir Composer rodar como root
ENV COMPOSER_ALLOW_SUPERUSER=1



# Instalar dependências Laravel
RUN composer install --no-dev --optimize-autoloader && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Porta padrão do Apache
EXPOSE 80

CMD ["apache2-foreground"]
