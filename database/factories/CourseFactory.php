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
        'video_link' => $faker->imageUrl($width = 640, $height = 480),
        'view_count' => $faker->numberBetween($min = 1000, $max = 9000),
        'category_id' => factory(App\Models\Category::class)->create()->id,
        'user_id' => factory(App\Models\User::class)->create()->id,
    ];
});
