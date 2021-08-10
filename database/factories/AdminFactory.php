<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => 'Admin',
        'type' => 'Super Admin',
        'email' => 'admin@gmail.com',
        'phone' => '0905428795',
        'password' => '123456', // password
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'subscribers' => $faker->numberBetween($min = 1000, $max = 9000),
    ];
});
