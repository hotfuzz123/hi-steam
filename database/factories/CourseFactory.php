<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'status' => $faker->randomElement(['active' ,'inactive']),
        'admin_id' => '1',
        'category_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});
