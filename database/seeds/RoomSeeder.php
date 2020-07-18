<?php

use Illuminate\Database\Seeder;
use App\Models\Room;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++){
            Room::create([
                'name' => Str::random(10),
                'image' => 'uploads/rooms/room'.$i.'.jpg',
                'hotel_id' => 1,
                'room_type_id' => random_int(1, 2),
            ]);
        }
    }
}
