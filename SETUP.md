# Laravel Room Booking System - Setup Instructions

## Overview

This is a complete Laravel room booking system that allows users to book rooms online and administrators to manage rooms and bookings. The system includes a public-facing website for room browsing and booking, an admin dashboard for managing rooms and bookings, and a REST API for integration with external systems.

## Features

- Room management (CRUD operations)
- Online booking with availability checking
- Admin dashboard with booking statistics
- Email notifications for new bookings
- REST API for external integrations
- Clean, responsive UI with Tailwind CSS

## Requirements

- PHP 8.2+
- MySQL 5.7+
- Composer
- Web server (Apache, Nginx, etc.)

## Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd laravel-booking
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment

Copy the `.env.example` file to `.env` and update the following settings:

```env
APP_NAME=RoomsBooking
APP_URL=http://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rooms_booking
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-smtp-username
MAIL_PASSWORD=your-smtp-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="booking@your-domain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. Create Database

Create a MySQL database named `rooms_booking` (or as specified in your `.env` file).

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Link Storage

```bash
php artisan storage:link
```

### 8. Create Admin User

For now, you can use Laravel's default authentication to create an admin user:

```bash
php artisan make:auth
```

Then visit `/register` to create an admin user account.

### 9. Configure Web Server

#### Apache

Make sure `mod_rewrite` is enabled and create an `.htaccess` file in the project root with the following content:

```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### Nginx

Configure your Nginx server to point to the `public` directory:

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/laravel-booking/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 10. Set File Permissions

Ensure the storage directory is writable by the web server:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## Usage

### Public Interface

- Browse rooms at `/rooms`
- View room details at `/rooms/{id}`
- Book a room at `/booking/{room_id}`

### Admin Interface

- Access admin dashboard at `/admin`
- Manage rooms at `/admin/rooms`
- Manage bookings at `/admin/bookings`

### API

- Get all rooms: `GET /api/rooms`

## Email Configuration

The system sends two types of emails:
1. Booking confirmation to the guest
2. New booking alert to the admin

Make sure your SMTP settings are correctly configured in the `.env` file.

## Security Considerations

1. Always keep your Laravel application updated
2. Use strong passwords for admin accounts
3. Configure HTTPS in production
4. Regularly backup your database
5. Implement rate limiting for the API if needed

## Troubleshooting

### Common Issues

1. **Permission Errors**: Make sure the storage directory is writable by the web server.
2. **Image Upload Issues**: Ensure the storage link is created and the correct permissions are set.
3. **Email Not Sending**: Verify your SMTP configuration in the `.env` file.
4. **404 Errors**: Check your web server configuration and ensure it's pointing to the `public` directory.

### Debug Mode

In development, you can enable debug mode by setting `APP_DEBUG=true` in your `.env` file. **Never enable debug mode in production.**

## Support

For support and issues, please create an issue in the repository or contact the development team.
>>>>>>> REPLACE
