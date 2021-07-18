<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Khoa học' ,'Công nghệ' ,'Kỹ thuật' ,'Nghệ thuật' ,'Toán học']),
        'icon' => $faker->imageUrl($width = 640, $height = 480),
        'status' => $faker->randomElement(['active' ,'inactive']),
    ];
});
