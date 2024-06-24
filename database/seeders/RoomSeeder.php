<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $rooms = [
        ['room_number' => '101', 'level' => 'regular'],
        ['room_number' => '102', 'level' => 'regular'],
        ['room_number' => '103', 'level' => 'regular'],
        ['room_number' => '104', 'level' => 'regular'],
        ['room_number' => '105', 'level' => 'regular'],
        ['room_number' => '106', 'level' => 'regular'],
        ['room_number' => '107', 'level' => 'regular'],
        ['room_number' => '201', 'level' => 'vip'],
        ['room_number' => '202', 'level' => 'vip'],
        ['room_number' => '203', 'level' => 'vip'],
    ];

    foreach ($rooms as $room) {
        \App\Models\Room::create($room);
    }
}
}
