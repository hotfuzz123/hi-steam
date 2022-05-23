<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Admin',
            'job' => 'Giáo viên',
            'email' => 'admin@gmail.com',
            'phone' => '0905428795',
            'password' => bcrypt('123456'), // password
            'avatar' => $this->faker->imageUrl($width = 640, $height = 480),
            'number_student_follow' => $this->faker->numberBetween($min = 1000, $max = 9000),
        ];
    }
}
