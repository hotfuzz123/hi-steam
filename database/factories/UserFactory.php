<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'avatar' => 'https://res.cloudinary.com/do4r5l3hd/image/upload/v1624046945/default/avatar.jpg',
        'public_id' => 'default/avatar',
        'dateOfBirth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'address' => $faker->address,
        'grade' => $faker->numberBetween($min = 1, $max = 12),
        'schoolName' => $faker->streetAddress,
        'email_verified_at' => now(),
        'password' => bcrypt('123456'), // password
        'remember_token' => Str::random(10),
    ];
});
