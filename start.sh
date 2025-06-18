echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Running npm"
npm install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Building production assets..."
npm run build