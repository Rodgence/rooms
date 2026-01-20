# HTTP 500 Error - Troubleshooting Guide

## Your Current Configuration
- Site: https://hostel.rodline.store
- Database: rodlines_hostel
- Environment: production (with DEBUG enabled temporarily)

## Quick Fix Steps

### Step 1: Check the Actual Error (On Server)
With APP_DEBUG=true, visit your site and note the specific error message. Common errors:

1. **"No application encryption key has been specified"**
   - Run: `php artisan key:generate`

2. **"SQLSTATE connection refused" or database errors**
   - Verify database exists: `rodlines_hostel`
   - Test connection: `php artisan migrate:status`
   - Run migrations: `php artisan migrate --force`

3. **"Permission denied" or file write errors**
   - Fix permissions (see Step 2)

4. **"Class not found" or autoload errors**
   - Run: `composer install --no-dev --optimize-autoloader`
   - Run: `php artisan clear-compiled && php artisan optimize`

### Step 2: Set Proper Permissions (Critical!)
```bash
# On your server, run these commands:
cd /path/to/your/project

# Set ownership to web server user (common options: www-data, apache, nginx)
sudo chown -R www-data:www-data storage bootstrap/cache

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# For cPanel/shared hosting
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### Step 3: Run Essential Laravel Commands
```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations (creates database tables)
php artisan migrate --force

# Create storage symbolic link
php artisan storage:link

# Cache everything for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 4: Check Web Server Configuration

#### For Apache (.htaccess in project root):
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### For cPanel/Shared Hosting:
- Document root MUST point to the `public` directory
- If you can't change document root, move contents of `public/` to root and update `index.php`:
  ```php
  require __DIR__.'/vendor/autoload.php';
  $app = require_once __DIR__.'/bootstrap/app.php';
  ```

### Step 5: Verify Database Setup
```bash
# Test database connection
php artisan tinker
>>> DB::connection()->getPdo();
>>> exit

# Check migration status
php artisan migrate:status

# If tables don't exist, run migrations
php artisan migrate --force
```

### Step 6: Build Frontend Assets
```bash
# Install dependencies
npm install --production

# Build assets
npm run build
```

### Step 7: Security - Disable Debug Mode
After confirming the site works, update `.env`:
```env
APP_DEBUG=false
```

Then clear and recache:
```bash
php artisan config:clear
php artisan config:cache
```

## Common Hosting-Specific Issues

### cPanel/Shared Hosting
1. PHP version must be 8.2+ (check in cPanel)
2. Enable PHP extensions: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON
3. Increase PHP memory limit to at least 256M
4. Document root must point to `public` folder

### VPS/Dedicated Server
1. Ensure web server user owns the files
2. SELinux may block writes (disable or configure properly)
3. Check PHP-FPM configuration
4. Verify MySQL is running and accessible

## Most Likely Causes (In Order)

1. **Storage permissions** - 80% of 500 errors
2. **Missing migrations** - Database tables not created
3. **Composer autoload** - Dependencies not installed properly
4. **Wrong document root** - Not pointing to `public/`
5. **PHP version** - Server running PHP < 8.2

## Automated Fix Script

Upload the `deploy-production.sh` script to your server and run:
```bash
chmod +x deploy-production.sh
./deploy-production.sh
```

## Still Not Working?

Check Laravel logs on the server:
```bash
tail -f storage/logs/laravel.log
```

Or check web server error logs:
```bash
# Apache
tail -f /var/log/apache2/error.log

# Nginx
tail -f /var/log/nginx/error.log

# cPanel
tail -f ~/logs/error_log
```

## Emergency Debug Mode

If you need to see the exact error on the live site temporarily:

1. In `.env`, confirm: `APP_DEBUG=true`
2. Run: `php artisan config:clear`
3. Visit the site to see the detailed error
4. **IMMEDIATELY** set `APP_DEBUG=false` after identifying the issue
5. Run: `php artisan config:cache`

## Contact Information

If issues persist, provide:
- The specific error message (with APP_DEBUG=true)
- Hosting provider (cPanel, VPS, etc.)
- PHP version
- Output of: `php artisan migrate:status`
- Contents of: `storage/logs/laravel.log`
