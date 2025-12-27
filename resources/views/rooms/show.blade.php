@extends('layouts.app')

@section('title', $room->name)

@push('styles')
<style>
    .hero-gradient {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
    }
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .amenity-card {
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    .amenity-card:hover {
        border-left-color: #6366f1;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .booking-card {
        background: linear-gradient(145deg, #ffffff, #f8fafc);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .price-badge {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .feature-icon {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    .float-animation {
        animation: float 3s ease-in-out infinite;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="relative hero-gradient min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <!-- Room Image with Overlay -->
    <div class="absolute inset-0">
        @if ($room->image)
            <img src="{{ $room->image_url }}" alt="{{ $room->name }}" class="w-full h-full object-cover opacity-30">
        @endif
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black"></div>
    </div>
    
    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 py-20">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Breadcrumb -->
            <nav class="flex justify-center mb-8">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}" class="text-white text-opacity-80 hover:text-opacity-100 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-white text-opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ url('/rooms') }}" class="text-white text-opacity-80 hover:text-opacity-100 ml-1 md:ml-2 text-sm font-medium transition-all duration-300">Rooms</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-white text-opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-white text-opacity-60 ml-1 md:ml-2 text-sm font-medium">{{ $room->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <!-- Room Title -->
            <div class="mb-6">
                <span class="inline-block glass-effect px-4 py-2 rounded-full text-white text-sm font-semibold mb-4">
                    {{ $room->type }} Experience
                </span>
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-4 tracking-tight">{{ $room->name }}</h1>
                <div class="flex flex-col md:flex-row items-center justify-center gap-4 text-white">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span class="text-xl">{{ $room->max_guests }} {{ $room->max_guests > 1 ? 'Guests' : 'Guest' }}</span>
                    </div>
                    <div class="hidden md:block w-1 h-1 bg-white bg-opacity-40 rounded-full"></div>
                    <div class="price-badge px-4 py-2 rounded-full float-animation">
                        <span class="text-2xl font-bold">${{ number_format($room->price, 2) }}</span>
                        <span class="text-sm font-normal">/night</span>
                    </div>
                </div>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-8 h-8 text-white text-opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="relative -mt-20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Room Details -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Description Section -->
                <div class="bg-white rounded-2xl shadow-xl p-8 transform -translate-y-10">
                    <div class="flex items-center mb-6">
                        <div class="feature-icon w-12 h-12 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Elegant Living Space</h2>
                    </div>
                    
                    <p class="text-lg text-gray-700 leading-relaxed mb-8">{{ $room->description }}</p>
                    
                    <!-- Key Features -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="amenity-card bg-gray-50 p-6 rounded-xl">
                            <div class="flex items-center mb-3">
                                <div class="feature-icon w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Flexible Check-in</h3>
                            </div>
                            <p class="text-gray-600">Check-in from 2:00 PM, check-out by 11:00 AM</p>
                        </div>
                        
                        <div class="amenity-card bg-gray-50 p-6 rounded-xl">
                            <div class="flex items-center mb-3">
                                <div class="feature-icon w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Spacious Comfort</h3>
                            </div>
                            <p class="text-gray-600">Designed for your ultimate comfort and relaxation</p>
                        </div>
                    </div>
                </div>
                
                <!-- Amenities Section -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="flex items-center mb-8">
                        <div class="feature-icon w-12 h-12 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Premium Amenities</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="amenity-card bg-gradient-to-br from-indigo-50 to-purple-50 p-5 rounded-xl border border-indigo-100">
                            <div class="flex items-center mb-2">
                                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-900">High-Speed WiFi</span>
                            </div>
                            <p class="text-sm text-gray-600 ml-11">Complimentary premium internet</p>
                        </div>
                        
                        <div class="amenity-card bg-gradient-to-br from-indigo-50 to-purple-50 p-5 rounded-xl border border-indigo-100">
                            <div class="flex items-center mb-2">
                                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-900">Climate Control</span>
                            </div>
                            <p class="text-sm text-gray-600 ml-11">Personalized temperature</p>
                        </div>
                        
                        <div class="amenity-card bg-gradient-to-br from-indigo-50 to-purple-50 p-5 rounded-xl border border-indigo-100">
                            <div class="flex items-center mb-2">
                                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-900">Smart TV</span>
                            </div>
                            <p class="text-sm text-gray-600 ml-11">55" 4K with streaming</p>
                        </div>
                        
                        <div class="amenity-card bg-gradient-to-br from-indigo-50 to-purple-50 p-5 rounded-xl border border-indigo-100">
                            <div class="flex items-center mb-2">
                                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-900">Luxury Bath</span>
                            </div>
                            <p class="text-sm text-gray-600 ml-11">Marble with premium fixtures</p>
                        </div>
                        
                        <div class="amenity-card bg-gradient-to-br from-indigo-50 to-purple-50 p-5 rounded-xl border border-indigo-100">
                            <div class="flex items-center mb-2">
                                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-900">Mini Bar</span>
                            </div>
                            <p class="text-sm text-gray-600 ml-11">Stocked with premium selections</p>
                        </div>
                        
                        <div class="amenity-card bg-gradient-to-br from-indigo-50 to-purple-50 p-5 rounded-xl border border-indigo-100">
                            <div class="flex items-center mb-2">
                                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-900">Concierge</span>
                            </div>
                            <p class="text-sm text-gray-600 ml-11">24/7 personalized service</p>
                        </div>
                    </div>
                </div>
                
                <!-- Experience Section -->
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 text-white">
                    <h2 class="text-3xl font-bold mb-6">The {{ $room->name }} Experience</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="glass-effect p-6 rounded-xl">
                            <h3 class="text-xl font-semibold mb-3">Arrival</h3>
                            <p class="text-indigo-100">Seamless check-in with welcome amenities and personalized service from the moment you arrive.</p>
                        </div>
                        <div class="glass-effect p-6 rounded-xl">
                            <h3 class="text-xl font-semibold mb-3">Stay</h3>
                            <p class="text-indigo-100">Immerse yourself in luxury with premium amenities and thoughtful touches throughout your stay.</p>
                        </div>
                        <div class="glass-effect p-6 rounded-xl">
                            <h3 class="text-xl font-semibold mb-3">Departure</h3>
                            <p class="text-indigo-100">Effortless check-out process with assistance for your onward journey.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Booking Card -->
            <div class="lg:col-span-1">
                <div class="sticky top-6">
                    <div class="booking-card rounded-2xl overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 text-white">
                            <div class="text-center">
                                <p class="text-indigo-200 text-sm font-medium mb-1">Exclusive Rate</p>
                                <div class="flex items-center justify-center">
                                    <span class="text-4xl font-bold">${{ number_format($room->price, 2) }}</span>
                                    <span class="text-lg ml-1">/night</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600">Room Type</span>
                                    <span class="font-medium text-gray-900">{{ $room->type }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600">Capacity</span>
                                    <span class="font-medium text-gray-900">{{ $room->max_guests }} Guests</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600">Availability</span>
                                    <span class="font-medium">
                                        @if ($room->status === 'active')
                                            <span class="text-green-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Available
                                            </span>
                                        @else
                                            <span class="text-red-600">Not Available</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <a href="{{ route('booking.create', $room->id) }}" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 px-4 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 text-center font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Reserve Now
                            </a>
                            
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <p class="text-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 inline mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Free cancellation up to 24 hours before
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Card -->
                    <div class="mt-6 bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Personal Assistance</h3>
                        <p class="text-gray-600 mb-4">Our dedicated team is ready to assist you with any special requests or questions.</p>
                        <div class="space-y-3">
                            <a href="mailto:info@{{ config('app.name', 'roomsbooking') }}.com" class="flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                info@{{ config('app.name', 'roomsbooking') }}.com
                            </a>
                            <a href="tel:+1234567890" class="flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                +1 (234) 567-890
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer CTA -->
<div class="bg-gray-900 py-16 mt-20">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Ready for an Exceptional Stay?</h2>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-8">Experience the perfect blend of luxury and comfort in our {{ $room->name }}.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('booking.create', $room->id) }}" class="bg-white text-gray-900 font-bold py-3 px-8 rounded-full hover:bg-gray-100 transition-colors duration-300 shadow-lg">
                Book Your Stay
            </a>
            <a href="{{ url('/rooms') }}" class="border-2 border-white text-white font-bold py-3 px-8 rounded-full hover:bg-white hover:text-gray-900 transition-all duration-300">
                View All Rooms
            </a>
        </div>
    </div>
</div>
@endsection
