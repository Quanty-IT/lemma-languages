#!/bin/sh
set -e  # Faz o script parar se qualquer comando falhar

echo "Rodando composer..."
composer install --optimize-autoloader --no-dev

echo "Rodando npm..."
npm ci

echo "Executando migrations..."
until php artisan migrate --force; do
  echo "Esperando o banco de dados ficar pronto..."
  sleep 5
done

echo "Compilando assets..."
npm run build

echo "Iniciando supervisord (nginx + php-fpm)..."
exec /start.sh
