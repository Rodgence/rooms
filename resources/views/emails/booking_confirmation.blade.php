<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
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
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #6b7280;
        }
        .payment-details {
            background-color: #fff7ed;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #fed7aa;
        }
        .payment-details h3 {
            color: #c2410c;
            margin-top: 0;
        }
        .account-box {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            border: 1px solid #e5e7eb;
        }
        .account-box h4 {
            margin-top: 0;
            color: #047857;
        }
        .account-box table {
            width: 100%;
        }
        .account-box td {
            padding: 6px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .account-box td:first-child {
            font-weight: bold;
            width: 40%;
            color: #6b7280;
        }
        .note {
            background-color: #fef3c7;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 4px solid #f59e0b;
            margin-top: 15px;
        }
        .contact-box {
            background-color: #f0fdf4;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #bbf7d0;
        }
        .contact-box h4 {
            margin-top: 0;
            color: #047857;
        }
        .contact-box table {
            width: 100%;
        }
        .contact-box td {
            padding: 5px 0;
        }
        .contact-box td:first-child {
            font-weight: bold;
            width: 30%;
            color: #6b7280;
        }
        .whatsapp-box {
            background-color: #dcfce7;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #86efac;
        }
        .whatsapp-box h4 {
            margin-top: 0;
            color: #166534;
        }
        .whatsapp-btn {
            display: inline-block;
            background-color: #25D366;
            color: white !important;
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }
        .whatsapp-btn:hover {
            background-color: #128C7E;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Booking Confirmation</h1>
        <p>{{ config('app.name') }}</p>
    </div>
    
    <div class="content">
        <p>Dear {{ $booking->full_name }},</p>
        
        <p>Thank you for your booking. Your reservation has been received and is currently pending confirmation.</p>
        
        <div class="booking-details">
            <h3>Booking Details</h3>
            <table>
                <tr>
                    <td>Booking ID:</td>
                    <td>#{{ $booking->id }}</td>
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
        
        <p>We will review your booking and send you a confirmation email shortly.</p>
        
        <div class="payment-details">
            <h3>Payment Information</h3>
            <p>To complete your booking, please make your payment to one of the following accounts:</p>
            
            <div class="account-box">
                <h4>Tanzania Shilling Account (TZS)</h4>
                <table>
                    <tr>
                        <td>Bank:</td>
                        <td>CRDB Bank</td>
                    </tr>
                    <tr>
                        <td>Account Name:</td>
                        <td style="user-select: all;">CATHEDRAL HOSTEL PARTNERSHIP</td>
                    </tr>
                    <tr>
                        <td>Account Number:</td>
                        <td style="user-select: all; font-weight: bold; font-size: 16px;">10121257802</td>
                    </tr>
                </table>
            </div>
            
            <div class="account-box">
                <h4>United States Dollar Account (USD)</h4>
                <table>
                    <tr>
                        <td>Bank:</td>
                        <td>CRDB Bank</td>
                    </tr>
                    <tr>
                        <td>Account Name:</td>
                        <td style="user-select: all;">CATHEDRAL HOSTEL PARTNERSHIP</td>
                    </tr>
                    <tr>
                        <td>Account Number:</td>
                        <td style="user-select: all; font-weight: bold; font-size: 16px;">10121264353</td>
                    </tr>
                </table>
            </div>
            
            <p class="note"><strong>Note:</strong> You are suggested to make some deposits for your account activation: <strong>150,000 TZS</strong> or <strong>150 USD</strong></p>
        </div>
        
        <div class="contact-box">
            <h4>Need Assistance?</h4>
            <p>Contact our Sales and Support Officer:</p>
            <table>
                <tr>
                    <td>Name:</td>
                    <td>Nassor Ali</td>
                </tr>
                <tr>
                    <td>Branch:</td>
                    <td>Zanzibar Branch</td>
                </tr>
                <tr>
                    <td>Mobile:</td>
                    <td style="user-select: all;">255773494985</td>
                </tr>
                <tr>
                    <td>Ext No:</td>
                    <td style="user-select: all;">23508</td>
                </tr>
            </table>
        </div>
        
        <div class="whatsapp-box">
            <h4>📱 Send Payment Receipt via WhatsApp</h4>
            <p>After making your payment, please send a photo of your receipt via WhatsApp:</p>
            <p style="text-align: center; margin: 15px 0;">
                <a href="https://wa.me/255714791904?text=Hello%2C%20I%20have%20made%20a%20payment%20for%20booking%20%23{{ $booking->id }}%20and%20would%20like%20to%20send%20my%20receipt." class="whatsapp-btn">
                    Send Receipt on WhatsApp
                </a>
            </p>
            <p style="text-align: center; font-size: 14px; color: #6b7280;">
                Or message us directly at: <span style="user-select: all; font-weight: bold;">+255 714 791 904</span>
            </p>
        </div>
        
        <p>If you have any questions, please contact us.</p>
        
        <p>Best regards,<br>{{ config('app.name') }} Team</p>
    </div>
    
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>
</html>
