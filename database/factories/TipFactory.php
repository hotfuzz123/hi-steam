<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tip;
use Faker\Generator as Faker;

$factory->define(Tip::class, function (Faker $faker) {
    return [
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'status' => $faker->randomElement(['active' ,'inactive']),
    ];
});
