# Usar a imagem oficial do PHP 8 com Apache
FROM php:8.2-apache

# Instalar extensões necessárias (pdo_mysql e outras comuns)
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Habilitar o mod_rewrite do Apache (útil para URLs amigáveis em PHP)
RUN a2enmod rewrite

# Copiar arquivos do projeto para dentro do container
COPY . /var/www/html/

# Definir permissões (caso precise gravar arquivos)
RUN chown -R www-data:www-data /var/www/html

# Expor a porta do Apache
EXPOSE 80