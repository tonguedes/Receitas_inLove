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

# Copiar arquivos do projeto
COPY . .

# Copiar arquivo de ambiente
COPY .env.example .env

# Permitir Composer funcionar como root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Instalar dependências antes de rodar comandos artisan
RUN composer install --no-dev --optimize-autoloader

# Gerar chave da aplicação
RUN php artisan key:generate

# Corrigir permissões
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache

# Cache de configuração
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Expor porta padrão
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]
