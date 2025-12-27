@extends('layouts.app')

@section('title', 'Rooms')

@section('content')
<div class="bg-white shadow rounded-lg p-6 mb-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Our Rooms</h1>
    <p class="text-gray-600">Choose from our comfortable and affordable rooms</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($rooms as $room)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="h-48 bg-gray-200 overflow-hidden">
                @if ($room->image)
                    <img src="{{ $room->image_url }}" alt="{{ $room->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-300">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">{{ $room->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $room->type }}</p>
                    </div>
                    <span class="text-lg font-bold text-indigo-600">${{ number_format($room->price, 2) }}<span class="text-sm font-normal text-gray-500">/night</span></span>
                </div>
                
                <div class="mt-3 flex items-center text-sm text-gray-600">
                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    Max {{ $room->max_guests }} {{ $room->max_guests > 1 ? 'Guests' : 'Guest' }}
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('rooms.show', $room->id) }}" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition-colors duration-300 text-center inline-block">
                        View Details
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{ $rooms->links() }}
@endsection
>>>>>>> REPLACE
