<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Slider;
use Faker\Generator as Faker;

$factory->define(Slider::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
        'url' => $faker->imageUrl($width = 640, $height = 480),
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'public_id' => $faker->imageUrl($width = 640, $height = 480),
        'description' => $faker->text($maxNbChars = 200),
        'status' => $faker->randomElement(['active' ,'inactive']),
    ];
});
