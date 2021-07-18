<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Document;
use Faker\Generator as Faker;

$factory->define(Document::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'link' => 'https://player.vimeo.com/video/270134945',
        'status' => $faker->randomElement(['active' ,'inactive']),
        'admin_id' => '1',
        'lesson_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
