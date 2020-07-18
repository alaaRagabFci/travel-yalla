<?php

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hotel::create([
            'name' => 'Hotel 1',
            'address' => 'Cairo,madinat nasr',
            'city' => 'Madinat nasr',
            'state' => 'State 1',
            'country' => 'Cairo',
            'zip_code' => '12345',
            'phone' => '+201013696675',
            'email' => 'alaaragab34@gmail.com',
            'image' => 'uploads/hotels/hotel1.jpg',
        ]);
    }
}
