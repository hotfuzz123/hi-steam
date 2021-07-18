<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mission;
use Faker\Generator as Faker;

$factory->define(Mission::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'lesson_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
