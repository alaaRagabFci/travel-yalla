<?php

use Illuminate\Database\Seeder;
use App\Models\Booking;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++){
            Booking::create([
                'room_id' => random_int(1, 10),
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 7 days')),
                'fullname' => Str::random(15),
                'email' => Str::random(10).'@gmail.com',
                'phone' => '+201015485542',
                'duration' => random_int(1, 8),
                'amount' => rand(5000, 15000),
                'user_id' => null,
            ]);
        }
    }
}
