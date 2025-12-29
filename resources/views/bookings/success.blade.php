@extends('layouts.app')

@section('title', 'Booking Successful')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="p-8 text-center">
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
            <svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Booking Successful!</h1>
        <p class="text-gray-600 mb-8">Your booking has been submitted and is pending confirmation.</p>
        
        <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left max-w-md mx-auto">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Booking Details</h2>
            
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Room:</span>
                    <span class="font-medium">{{ $booking->room->name }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Check-in:</span>
                    <span class="font-medium">{{ $booking->check_in->format('M d, Y') }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Check-out:</span>
                    <span class="font-medium">{{ $booking->check_out->format('M d, Y') }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Guests:</span>
                    <span class="font-medium">{{ $booking->guests }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Price:</span>
                    <span class="font-medium">${{ number_format($booking->total_price, 2) }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Status:</span>
                    <span class="font-medium">
                        @if ($booking->status === 'pending')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @endif
                    </span>
                </div>
            </div>
        </div>
        
        <div class="space-y-4">
            <p class="text-gray-600">
                A confirmation email has been sent to <strong>{{ $booking->email }}</strong>.
            </p>
            
            <p class="text-gray-600">
                We will review your booking and send you a confirmation email shortly.
            </p>
        </div>
        
        <div class="mt-8">
            <a href="{{ url('/rooms') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#196890] hover:bg-[#145570] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#196890]">
                Browse More Rooms
            </a>
        </div>
    </div>
</div>
@endsection
