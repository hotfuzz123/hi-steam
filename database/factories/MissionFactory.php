<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mission;
use Faker\Generator as Faker;

$factory->define(Mission::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => 'https://res.cloudinary.com/do4r5l3hd/image/upload/v1624046945/default/avatar.jpg',
        'public_id' => 'default/avatar',
        'description' => $faker->text($maxNbChars = 200),
        'status' => $faker->numberBetween($min = 0, $max = 1),
        'grade_id' => factory(App\Models\Grade::class)->create()->id,
    ];
});
