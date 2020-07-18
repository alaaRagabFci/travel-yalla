<?php

use Illuminate\Database\Seeder;
use App\Models\Price;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 30; $i++){
            Price::create([
                'price' => rand(4000, 10000),
                'room_type_id' => random_int(1, 2),
            ]);
        }
    }
}
