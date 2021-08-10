<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->country,
        'lesson_id' => '1',
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
