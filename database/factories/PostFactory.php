<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'content' => $faker->text($maxNbChars = 200),
        'description' => $faker->text($maxNbChars = 200),
        'status' => $faker->randomElement(['public' ,'draft']),
        'admin_id' => '1',
    ];
});
