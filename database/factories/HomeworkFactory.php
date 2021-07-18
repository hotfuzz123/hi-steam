<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Homework;
use Faker\Generator as Faker;

$factory->define(Homework::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'file' => $faker->imageUrl($width = 640, $height = 480),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'lesson_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
