# QUICK FIX for HTTP 500 Error - APP_KEY Issue

## The Problem
Your `.env` file has an APP_KEY, but Laravel can't read it because the configuration is cached with an empty key.

## Solution 1: SSH Access (FASTEST)

If you have SSH access to your server, run these commands:

```bash
cd /home/rodlines/hostel.rodline.store

# Clear cached configuration (THIS IS THE KEY STEP!)
php artisan config:clear

# Verify APP_KEY exists in .env
grep APP_KEY .env

# If APP_KEY is empty or missing, generate a new one
php artisan key:generate

# Clear all caches
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Recache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Then visit: https://hostel.rodline.store

## Solution 2: No SSH Access (File Manager/FTP)

### Option A: Delete Cached Config File

1. Use your hosting file manager or FTP
2. Navigate to: `/home/rodlines/hostel.rodline.store/bootstrap/cache/`
3. Delete the file: `config.php`
4. Visit your site: https://hostel.rodline.store

### Option B: Use Emergency Script

1. Upload the `fix-app-key.php` file to your server root
2. Visit: https://hostel.rodline.store/fix-app-key.php
3. Follow the instructions on the page
4. **DELETE the fix-app-key.php file immediately after running it**

## Solution 3: Manual .env Fix (If others don't work)

1. SSH or use file manager to edit `/home/rodlines/hostel.rodline.store/.env`
2. Find the line: `APP_KEY=base64:gh1I1DaPv9dNqlYYXopQa5nOwhqfxDt3EfTy6OiuFXs=`
3. If it's empty or missing, add this line:
   ```
   APP_KEY=base64:gh1I1DaPv9dNqlYYXopQa5nOwhqfxDt3EfTy6OiuFXs=
   ```
4. Delete: `bootstrap/cache/config.php`
5. Visit your site

## Verify the Fix

After applying any solution, check:

1. Visit: https://hostel.rodline.store
2. You should see your Laravel application instead of HTTP 500 error
3. Check logs: `tail -f storage/logs/laravel.log` (should have no more APP_KEY errors)

## After It's Working

Don't forget to:

1. Set `APP_DEBUG=false` in `.env`
2. Run: `php artisan config:cache`
3. Delete `fix-app-key.php` if you used it
4. Run remaining setup commands:
   ```bash
   php artisan migrate --force
   php artisan storage:link
   npm run build
   ```

## Why This Happened

Laravel caches configuration in production. When you deployed, the config was cached before the APP_KEY was set, or the cached config contained an empty key. The `php artisan config:clear` command removes this cache, forcing Laravel to read the .env file again.

## Still Not Working?

Check that:
1. `.env` file exists on the server
2. `.env` file has the correct APP_KEY line
3. File permissions allow web server to read `.env` (chmod 644)
4. You cleared ALL caches, especially `bootstrap/cache/config.php`

If still having issues, run:
```bash
php artisan tinker
>>> config('app.key')
```

This should output your key. If it returns null, the .env is not being read.
