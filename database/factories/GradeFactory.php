<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Grade;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) {
    return [
        'score' => $faker->numberBetween($min = 4, $max = 10),
        'comment' => $faker->randomElement(['Tuyệt vời' ,'Tốt', 'Tạm được', 'Quá tệ']),
        'homework_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
