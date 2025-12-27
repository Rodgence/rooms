<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::where('status', 'active')->get();
        
        return response()->json($rooms->map(function ($room) {
            return [
                'id' => $room->id,
                'name' => $room->name,
                'price' => $room->price,
                'max_guests' => $room->max_guests,
                'image' => $room->image_url,
                'booking_url' => url('/rooms/' . $room->id)
            ];
        }));
    }
}
>>>>>>> REPLACE
