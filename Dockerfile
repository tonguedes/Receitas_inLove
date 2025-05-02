FROM php:8.2-cli

# ... suas dependências (git, unzip, etc)

# Instale o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Crie usuário normal para evitar problema com root
RUN useradd -ms /bin/bash appuser
USER appuser

# Copie os arquivos da aplicação
COPY . /var/www
WORKDIR /var/www

# Instale dependências sem scripts automáticos
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Volte a rodar scripts manualmente
RUN php artisan package:discover

