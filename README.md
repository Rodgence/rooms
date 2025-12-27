# Laravel Room Booking System

A complete, production-ready Laravel room booking system with admin panel and REST API.

## Features

### Room Management (Admin)
- Create, edit, and delete rooms
- Upload room images
- Set room details (name, type, price, max guests, description)
- Activate/deactivate rooms

### Public Interface
- Browse available rooms
- View room details
- Book rooms with date selection
- Automatic price calculation

### Booking System
- Date-based availability checking
- Prevent overlapping bookings
- Guest information collection
- Booking status management (pending, confirmed, cancelled)

### Admin Dashboard
- Booking statistics
- Booking management (approve, cancel, delete)
- Recent bookings overview

### REST API
- Public endpoint for room data
- JSON response format
- CORS configured for cross-origin requests

### Email Notifications
- Booking confirmation to guests
- New booking alerts to admin
- SMTP configuration

## Technology Stack

- **Backend**: Laravel 11
- **PHP**: 8.2+
- **Database**: MySQL
- **Frontend**: Blade + Tailwind CSS
- **Authentication**: Laravel default (admin only)

## Installation

See [SETUP.md](SETUP.md) for detailed installation instructions.

## API Documentation

### Get Rooms

**Endpoint:** `GET /api/rooms`

**Response:**
```json
[
  {
    "id": 1,
    "name": "Standard Garden View",
    "price": 80,
    "max_guests": 2,
    "image": "https://booking.cathedralhostel.com/storage/rooms/room1.jpg",
    "booking_url": "https://booking.cathedralhostel.com/rooms/1"
  }
]
```

## Project Structure

```
laravel-booking/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── Api/
│   │   │   │   └── RoomController.php
│   │   │   ├── BookingController.php
│   │   │   └── RoomController.php
│   ├── Models/
│   │   ├── Booking.php
│   │   └── Room.php
│   └── Mail/
│       ├── BookingConfirmation.php
│       └── NewBookingAlert.php
├── config/
│   └── cors.php
├── database/
│   └── migrations/
│       ├── create_rooms_table.php
│       └── create_bookings_table.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── rooms/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── bookings/
│   │   │   ├── create.blade.php
│   │   │   └── success.blade.php
│   │   ├── admin/
│   │   │   └── dashboard.blade.php
│   │   └── emails/
│   │       ├── booking_confirmation.blade.php
│   │       └── new_booking_alert.blade.php
├── routes/
│   ├── api.php
│   └── web.php
└── SETUP.md
```

## Database Schema

### rooms Table
- id (Primary Key)
- name
- type
- price (decimal)
- max_guests (integer)
- description (text, nullable)
- image (string, nullable)
- status (enum: active, inactive)
- created_at
- updated_at

### bookings Table
- id (Primary Key)
- room_id (Foreign Key)
- full_name
- email
- phone
- check_in (date)
- check_out (date)
- guests (integer)
- nights (integer)
- total_price (decimal)
- status (enum: pending, confirmed, cancelled)
- created_at
- updated_at

## Security Features

- CSRF protection enabled
- Input validation on all forms
- CORS configured for API
- File upload validation (images only)
- SQL injection prevention through Eloquent ORM

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is licensed under the MIT license.
>>>>>>> REPLACE
