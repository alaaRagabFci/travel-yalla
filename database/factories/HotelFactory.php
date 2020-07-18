<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

//use App\Models\Hotel;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Hotel::class, function (Faker $faker) {
    return [
        'name' => 'HotelTest',
        'address' => $faker->address,
        'city' => $faker->city,
        'country' => $faker->country,
        'state' => $faker->state,
        'zip_code' => rand(12345, 23548),
        'phone' => $faker->phoneNumber,
        'email' => Str::random(10).'@yahoo.com',
        'image' => 'uploads/hotels/'.Str::random(100).'jpg',
    ];
});
