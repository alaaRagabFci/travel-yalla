<?php

use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::insert([['name' => 'Deluxe'], ['name' => 'Standard']]);
    }
}
