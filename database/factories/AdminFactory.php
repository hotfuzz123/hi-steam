<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => 'Admin',
        'type' => 'Super Admin',
        'mobile' => '0905428795',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('123456'), // password
        'image' => 'https://res.cloudinary.com/do4r5l3hd/image/upload/v1624046945/default/avatar.jpg',
        'public_id' => 'default/avatar',
        'status' => '1',
    ];
});
