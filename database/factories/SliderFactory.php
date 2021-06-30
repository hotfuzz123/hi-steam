<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Slider;
use Faker\Generator as Faker;

$factory->define(Slider::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
        'url' => $faker->imageUrl($width = 640, $height = 480),
        'image' => 'https://res.cloudinary.com/do4r5l3hd/image/upload/v1624046945/default/avatar.jpg',
        'public_id' => 'default/avatar',
        'description' => $faker->text($maxNbChars = 200),
        'status' => $faker->randomElement(['active' ,'inactive']),
    ];
});
