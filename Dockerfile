# 1. Imagem base oficial do PHP com FPM
FROM php:8.2-fpm

# 2. Instalação de dependências essenciais do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# 3. Instalação das extensões PHP para MySQL (Obrigatório para o Laravel)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 4. Copia o Composer (Gerenciador de pacotes do PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Define a pasta de trabalho
WORKDIR /var/www

# 6. Usuário padrão para evitar conflitos de permissão no Windows
USER www-data