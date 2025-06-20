FROM richarvey/nginx-php-fpm:3.1.6

# Instala Node.js, NPM, Composer, etc.
RUN apk update && apk add --no-cache \
    curl \
    nodejs \
    npm \
    bash \
    git \
    unzip

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia todos os arquivos do projeto para a imagem
COPY . .

# Copia o script de inicialização personalizado
COPY start.sh /usr/local/bin/custom-start.sh
RUN chmod +x /usr/local/bin/custom-start.sh

# Configura variáveis de ambiente
ENV WEBROOT=/var/www/html/public \
    PHP_ERRORS_STDERR=1 \
    APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    COMPOSER_ALLOW_SUPERUSER=1

# Define o script de inicialização padrão
CMD ["/usr/local/bin/custom-start.sh"]
