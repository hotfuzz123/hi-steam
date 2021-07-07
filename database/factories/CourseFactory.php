<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
        'material' => $faker->text($maxNbChars = 200),
        'description' => $faker->text($maxNbChars = 200),
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'public_id' => $faker->imageUrl($width = 640, $height = 480),
        'video_link' => 'https://player.vimeo.com/video/270134945',
        'view_count' => $faker->numberBetween($min = 1000, $max = 9000),
        'status' => $faker->randomElement(['active' ,'inactive']),
        'admin_id' => '1',
        'category_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});
