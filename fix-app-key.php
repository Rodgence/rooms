<?php
/**
 * Emergency APP_KEY Fix Script
 * Upload this file to your server root and access it via browser
 * Example: https://hostel.rodline.store/fix-app-key.php
 *
 * DELETE THIS FILE after running it!
 */

// Security: Only allow running once, then self-destruct
$envPath = __DIR__ . '/.env';
$envExamplePath = __DIR__ . '/.env.example';

if (!file_exists($envPath)) {
    die('Error: .env file not found. Please create it from .env.example');
}

// Generate a random 32-character key
$key = 'base64:' . base64_encode(random_bytes(32));

// Read current .env content
$envContent = file_get_contents($envPath);

// Check if APP_KEY exists and update it
if (preg_match('/^APP_KEY=.*$/m', $envContent)) {
    // Update existing APP_KEY
    $envContent = preg_replace(
        '/^APP_KEY=.*$/m',
        'APP_KEY=' . $key,
        $envContent
    );
} else {
    // Add APP_KEY if it doesn't exist
    $envContent = preg_replace(
        '/^(APP_NAME=.*$)/m',
        "$1\nAPP_KEY=" . $key,
        $envContent
    );
}

// Backup old .env
copy($envPath, $envPath . '.backup.' . date('Y-m-d-His'));

// Write new .env
if (file_put_contents($envPath, $envContent)) {
    echo "<h1>✓ Success!</h1>";
    echo "<p>New APP_KEY has been generated and saved to .env</p>";
    echo "<p><strong>New Key:</strong> <code>" . htmlspecialchars($key) . "</code></p>";

    echo "<h2>Next Steps:</h2>";
    echo "<ol>";
    echo "<li>Clear Laravel cache by running: <code>php artisan config:clear</code></li>";
    echo "<li>Or delete the file: <code>bootstrap/cache/config.php</code></li>";
    echo "<li><strong>DELETE THIS FILE (fix-app-key.php) immediately!</strong></li>";
    echo "<li>Visit your site: <a href='https://hostel.rodline.store'>https://hostel.rodline.store</a></li>";
    echo "</ol>";

    echo "<h2>Clear Cache Options:</h2>";
    echo "<p><strong>Option 1 (Recommended):</strong> SSH into server and run:</p>";
    echo "<pre>cd /home/rodlines/hostel.rodline.store\nphp artisan config:clear\nphp artisan cache:clear</pre>";

    echo "<p><strong>Option 2:</strong> Use File Manager to delete:</p>";
    echo "<pre>bootstrap/cache/config.php</pre>";

    // Try to clear cache automatically
    $configCachePath = __DIR__ . '/bootstrap/cache/config.php';
    if (file_exists($configCachePath)) {
        if (@unlink($configCachePath)) {
            echo "<p style='color: green;'><strong>✓ Automatically deleted cached config file!</strong></p>";
        } else {
            echo "<p style='color: orange;'><strong>⚠ Could not automatically delete cache. Please do it manually.</strong></p>";
        }
    }

    echo "<hr>";
    echo "<p style='color: red; font-weight: bold;'>⚠️ SECURITY WARNING: DELETE THIS FILE NOW!</p>";

} else {
    echo "<h1>✗ Error</h1>";
    echo "<p>Could not write to .env file. Check file permissions.</p>";
}
?>
