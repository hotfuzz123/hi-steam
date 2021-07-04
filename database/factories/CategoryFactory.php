<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Khoa học' ,'Công nghệ' ,'Kỹ thuật' ,'Nghệ thuật' ,'Toán học']),
        'icon' => $faker->word,
        'description' => $faker->text($maxNbChars = 200),
        'status' => $faker->randomElement(['active' ,'inactive']),
    ];
});
