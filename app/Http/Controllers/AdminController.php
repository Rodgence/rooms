<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();
        
        $recentBookings = Booking::with('room')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'confirmedBookings',
            'cancelledBookings',
            'recentBookings'
        ));
    }

    /**
     * Display a listing of the bookings.
     */
    public function bookings()
    {
        $bookings = Booking::with('room')->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Approve the specified booking.
     */
    public function approveBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'confirmed';
        $booking->save();

        return redirect()->route('admin.bookings')
            ->with('success', 'Booking approved successfully.');
    }

    /**
     * Cancel the specified booking.
     */
    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->route('admin.bookings')
            ->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Remove the specified booking from storage.
     */
    public function deleteBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings')
            ->with('success', 'Booking deleted successfully.');
    }

    /**
     * Display a listing of customers.
     */
    public function customers()
    {
        $customers = Booking::select('email', 'full_name', 'phone')
            ->selectRaw('COUNT(*) as total_bookings')
            ->selectRaw('SUM(total_price) as total_spent')
            ->selectRaw('MAX(created_at) as last_booking')
            ->groupBy('email', 'full_name', 'phone')
            ->orderByDesc('last_booking')
            ->paginate(15);
        
        return view('admin.customers.index', compact('customers'));
    }
}
