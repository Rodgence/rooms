#!/bin/bash

# Laravel Production Deployment Script
# Run this script on your production server

echo "Starting Laravel production deployment..."

# 1. Set proper permissions
echo "Setting storage permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# 2. Clear and cache configuration
echo "Optimizing configuration..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 3. Run migrations
echo "Running database migrations..."
php artisan migrate --force

# 4. Create storage link
echo "Creating storage link..."
php artisan storage:link

# 5. Cache configuration for production
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Install and build assets
echo "Building frontend assets..."
npm install --production
npm run build

echo "Deployment completed!"
echo "IMPORTANT: Set APP_DEBUG=false in .env after verifying everything works"
