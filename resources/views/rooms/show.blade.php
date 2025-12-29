@extends('layouts.app')

@section('title', $room->name)

@push('styles')
<style>
    .hero-section {
        background: #196890;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
    }
    .breadcrumb-link {
        transition: all 0.2s ease;
    }
    .breadcrumb-link:hover {
        transform: translateX(2px);
    }
    .feature-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e5e7eb;
    }
    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: #196890;
    }
    .amenity-item {
        transition: all 0.2s ease;
    }
    .amenity-item:hover {
        transform: scale(1.02);
        background-color: #f9fafb;
    }
    .booking-sticky {
        position: sticky;
        top: 20px;
    }
    .price-highlight {
        background: #196890;
    }
    @media (max-width: 1024px) {
        .booking-sticky {
            position: static;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="hero-section relative min-h-[60vh] flex items-center justify-center">
    <!-- Room Image Overlay -->
    @if ($room->image)
        <div class="absolute inset-0">
            <img src="{{ $room->image_url }}" alt="{{ $room->name }}" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-black/30"></div>
        </div>
    @endif
    
    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 py-16">
        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ url('/') }}" class="breadcrumb-link text-white/80 hover:text-white flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li class="text-white/50">/</li>
                    <li>
                        <a href="{{ url('/rooms') }}" class="breadcrumb-link text-white/80 hover:text-white">Rooms</a>
                    </li>
                    <li class="text-white/50">/</li>
                    <li class="text-white/60">{{ $room->name }}</li>
                </ol>
            </nav>
            
            <!-- Room Title -->
            <div class="space-y-4">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/20">
                    <span class="text-white text-sm font-medium">{{ $room->type }} Room</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">{{ $room->name }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-white/90">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>Up to {{ $room->max_guests }} {{ $room->max_guests > 1 ? 'Guests' : 'Guest' }}</span>
                    </div>
                    <span class="text-white/50">•</span>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>${{ number_format($room->price, 2) }} per night</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="relative -mt-20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Room Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Description Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 transform -translate-y-10">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 mb-3">
                            <div class="w-1 h-6 bg-[#196890] rounded-full"></div>
                            <h2 class="text-2xl font-bold text-gray-900">Room Description</h2>
                        </div>
                    </div>
                    
                    <p class="text-base text-gray-600 leading-relaxed mb-8">{{ $room->description }}</p>
                    
                    <!-- Key Features -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="feature-card bg-white p-5 rounded-lg">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#196890]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-gray-900 mb-1">Flexible Check-in</h3>
                                    <p class="text-sm text-gray-600">Check-in from 2:00 PM, check-out by 11:00 AM</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="feature-card bg-white p-5 rounded-lg">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#196890]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-gray-900 mb-1">Spacious Comfort</h3>
                                    <p class="text-sm text-gray-600">Designed for your ultimate comfort and relaxation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Amenities Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 mb-3">
                            <div class="w-1 h-6 bg-[#196890] rounded-full"></div>
                            <h2 class="text-2xl font-bold text-gray-900">Premium Amenities</h2>
                        </div>
                        <p class="text-sm text-gray-600">Everything you need for a comfortable stay</p>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="amenity-item bg-gray-50 p-4 rounded-lg flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#196890]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900">High-Speed WiFi</span>
                        </div>
                        
                        <div class="amenity-item bg-gray-50 p-4 rounded-lg flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#196890]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Air Conditioning</span>
                        </div>
                        
                        <div class="amenity-item bg-gray-50 p-4 rounded-lg flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#196890]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Smart TV</span>
                        </div>
                        
                        <div class="amenity-item bg-gray-50 p-4 rounded-lg flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#196890]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Luxury Bath</span>
                        </div>
                        
                        <div class="amenity-item bg-gray-50 p-4 rounded-lg flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#196890]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Mini Bar</span>
                        </div>
                        
                        <div class="amenity-item bg-gray-50 p-4 rounded-lg flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#196890]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900">24/7 Concierge</span>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Right Column - Booking Card -->
            <div class="lg:col-span-1">
                <div class="booking-sticky">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transform -translate-y-10">
                        <!-- Price Header -->
                        <div class="price-highlight p-6 text-white">
                            <div class="text-center">
                                <p class="text-white/80 text-sm mb-2">Starting from</p>
                                <div class="flex items-baseline justify-center gap-1">
                                    <span class="text-5xl font-bold">${{ number_format($room->price, 0) }}</span>
                                    <span class="text-xl font-medium">/night</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Room Details -->
                        <div class="p-6">
                            <div class="space-y-4 mb-6">
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-sm text-gray-600">Room Type</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $room->type }}</span>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-sm text-gray-600">Capacity</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $room->max_guests }} {{ $room->max_guests > 1 ? 'Guests' : 'Guest' }}</span>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-sm text-gray-600">Availability</span>
                                    @if ($room->status === 'active')
                                        <span class="inline-flex items-center gap-1 text-sm font-semibold text-green-600">
                                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                            Available
                                        </span>
                                    @else
                                        <span class="text-sm font-semibold text-red-600">Not Available</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Reserve Button -->
                            <a href="{{ route('booking.create', $room->id) }}" class="block w-full bg-[#196890] hover:bg-[#145570] text-white text-center py-4 px-6 rounded-lg font-semibold text-base transition-all duration-200">
                                Reserve Now
                            </a>
                            
                            <!-- Cancellation Policy -->
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <p class="text-center text-xs text-gray-500 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Free cancellation up to 24 hours before</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Card -->
                    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="mb-4">
                            <h3 class="text-base font-bold text-gray-900 mb-1">Need Help?</h3>
                            <p class="text-sm text-gray-600">Our team is here to assist you</p>
                        </div>
                        <div class="space-y-3">
                            <a href="mailto:info@roomsbooking.com" class="flex items-center gap-3 text-sm text-gray-700 hover:text-[#196890] transition-colors">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-[#196890]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span>info@roomsbooking.com</span>
                            </a>
                            <a href="tel:+1234567890" class="flex items-center gap-3 text-sm text-gray-700 hover:text-[#196890] transition-colors">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-[#196890]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <span>+1 (234) 567-890</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer CTA -->
<div class="bg-[#000000] py-20 mt-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to Book Your Stay?</h2>
            <p class="text-lg text-gray-300 mb-8">Experience comfort and luxury at {{ $room->name }}</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('booking.create', $room->id) }}" class="inline-flex items-center justify-center px-8 py-3 bg-[#196890] text-white font-semibold rounded-lg hover:bg-[#145570] transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Book Now
                </a>
                <a href="{{ url('/rooms') }}" class="inline-flex items-center justify-center px-8 py-3 bg-transparent text-white font-semibold rounded-lg border-2 border-white hover:bg-white hover:text-gray-900 transition-all duration-200">
                    View All Rooms
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
