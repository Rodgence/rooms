<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'full_name',
        'email',
        'phone',
        'check_in',
        'check_out',
        'guests',
        'nights',
        'total_price',
        'status'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
