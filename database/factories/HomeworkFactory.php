<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Homework;
use Faker\Generator as Faker;

$factory->define(Homework::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'file' => 'https://res.cloudinary.com/do4r5l3hd/image/upload/v1624046945/default/avatar.jpg',
        'public_id' => 'default/avatar',
        'course_id' => factory(App\Models\Course::class)->create()->id,
    ];
});
