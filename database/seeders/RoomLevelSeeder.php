<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoomLevel;

class RoomLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomLevel::create(['name' => 'Level 1']);
        RoomLevel::create(['name' => 'Level 2']);
        RoomLevel::create(['name' => 'Level 3']);
    }
}
