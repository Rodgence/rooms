<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Alert</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4f46e5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9fafb;
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .booking-details {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .booking-details table {
            width: 100%;
        }
        .booking-details td {
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .booking-details td:first-child {
            font-weight: bold;
            width: 40%;
        }
        .status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .admin-button {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Booking Alert</h1>
        <p>{{ config('app.name') }} Admin Panel</p>
    </div>
    
    <div class="content">
        <p>Hello Admin,</p>
        
        <p>A new booking has been submitted and is awaiting your approval.</p>
        
        <div class="booking-details">
            <h3>Booking Details</h3>
            <table>
                <tr>
                    <td>Booking ID:</td>
                    <td>#{{ $booking->id }}</td>
                </tr>
                <tr>
                    <td>Guest Name:</td>
                    <td>{{ $booking->full_name }}</td>
                </tr>
                <tr>
                    <td>Guest Email:</td>
                    <td>{{ $booking->email }}</td>
                </tr>
                <tr>
                    <td>Guest Phone:</td>
                    <td>{{ $booking->phone }}</td>
                </tr>
                <tr>
                    <td>Room:</td>
                    <td>{{ $booking->room->name }}</td>
                </tr>
                <tr>
                    <td>Room Type:</td>
                    <td>{{ $booking->room->type }}</td>
                </tr>
                <tr>
                    <td>Check-in:</td>
                    <td>{{ $booking->check_in->format('F d, Y') }}</td>
                </tr>
                <tr>
                    <td>Check-out:</td>
                    <td>{{ $booking->check_out->format('F d, Y') }}</td>
                </tr>
                <tr>
                    <td>Number of Nights:</td>
                    <td>{{ $booking->nights }}</td>
                </tr>
                <tr>
                    <td>Guests:</td>
                    <td>{{ $booking->guests }}</td>
                </tr>
                <tr>
                    <td>Total Price:</td>
                    <td>${{ number_format($booking->total_price, 2) }}</td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td><span class="status status-pending">{{ $booking->status }}</span></td>
                </tr>
            </table>
        </div>
        
        <p>Please review this booking and take appropriate action.</p>
        
        <a href="{{ url('/admin/bookings') }}" class="admin-button">Review Booking</a>
        
        <p>Thank you,<br>{{ config('app.name') }} System</p>
    </div>
    
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>
</html>
>>>>>>> REPLACE
