<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Grade;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) {
    return [
        'score' => $faker->numberBetween($min = 1, $max = 10),
        'comment' => $faker->text($maxNbChars = 200),
        'user_id' => factory(App\Models\User::class)->create()->id,
    ];
});
