FROM richarvey/nginx-php-fpm:3.1.6

# Atualiza o sistema e instala Node.js 18 + npm
RUN apk update && apk add --no-cache \
    curl \
    nodejs \
    npm

# Define o diretório de trabalho da aplicação
WORKDIR /var/www/html

# Copia o código da aplicação
COPY . .

# Configurações de ambiente da imagem
ENV SKIP_COMPOSER 1 \
    WEBROOT /var/www/html/public \
    PHP_ERRORS_STDERR 1 \
    RUN_SCRIPTS 1 \
    REAL_IP_HEADER 1 \
    APP_ENV production \
    APP_DEBUG false \
    LOG_CHANNEL stderr \
    COMPOSER_ALLOW_SUPERUSER 1

# Comando de inicialização padrão
CMD ["/start.sh"]