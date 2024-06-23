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
        Room::create([
            'room_number' => '101',
        'room_level_id' => 1,
            'is_available' => true,
        ]);

    Room::create([
        'room_number' => '202',
    'room_level_id' => 1,
        'is_available' => true,
    ]);

        Room::create([
            'room_number' => '302',
            'room_level_id' => 2,
            'is_available' => true,]);

        Room::create([
            'room_number' => '401',
        'room_level_id' => 2,
            'is_available' => true,
        ]);

        Room::create([
                'room_number' => '601',
                'room_level_id' => 3,
                'is_available' => true,]);

        Room::create([
            'room_number' => '502',
        'room_level_id' => 3,
            'is_available' => true,
        ]);
    }
}
