<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'material' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'video_link' => 'https://player.vimeo.com/video/270134945',
        'view_count' => $faker->numberBetween($min = 1000, $max = 9000),
        'status' => $faker->randomElement(['active' ,'inactive']),
        'admin_id' => '1',
        'section_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
