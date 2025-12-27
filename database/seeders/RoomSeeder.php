<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Standard Garden View',
                'type' => 'Standard',
                'price' => 80,
                'max_guests' => 2,
                'description' => 'Comfortable room with a beautiful garden view. Perfect for couples or solo travelers looking for a peaceful stay.',
                'status' => 'active',
            ],
            [
                'name' => 'Deluxe Twin Room',
                'type' => 'Twin',
                'price' => 120,
                'max_guests' => 2,
                'description' => 'Spacious twin room with two separate beds. Ideal for friends or colleagues traveling together.',
                'status' => 'active',
            ],
            [
                'name' => 'Single Economy',
                'type' => 'Single',
                'price' => 60,
                'max_guests' => 1,
                'description' => 'Budget-friendly single room with all essential amenities. Perfect for solo travelers on a budget.',
                'status' => 'active',
            ],
            [
                'name' => 'Executive Double Suite',
                'type' => 'Double',
                'price' => 180,
                'max_guests' => 3,
                'description' => 'Luxurious suite with a king-size bed and additional seating area. Perfect for families or those seeking extra comfort.',
                'status' => 'active',
            ],
            [
                'name' => 'Family Room',
                'type' => 'Standard',
                'price' => 150,
                'max_guests' => 4,
                'description' => 'Spacious family room with multiple beds. Ideal for families with children.',
                'status' => 'active',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}