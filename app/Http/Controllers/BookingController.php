<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\NewBookingAlert;
use Carbon\Carbon;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    /**
     * Show the form for creating a new booking.
     */
    public function create($room_id)
    {
        $room = Room::findOrFail($room_id);
        return view('bookings.create', compact('room'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(BookingRequest $request)
    {
        $room = Room::findOrFail($request->room_id);
        
        // Calculate nights and total price
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price * $nights;

        // Create booking
        $booking = Booking::create([
            'room_id' => $request->room_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'nights' => $nights,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Send confirmation email to guest
        Mail::to($request->email)->send(new BookingConfirmation($booking));
        
        // Send notification email to admin
        Mail::to(config('mail.admin_email', 'admin@example.com'))->send(new NewBookingAlert($booking));

        return redirect()->route('booking.success', $booking->id)
            ->with('success', 'Your booking has been submitted successfully!');
    }

    /**
     * Show booking success page.
     */
    public function success($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.success', compact('booking'));
    }
}
