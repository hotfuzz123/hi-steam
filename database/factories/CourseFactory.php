<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->country,
            'status' => $this->faker->randomElement(['active' ,'inactive']),
            'admin_id' => '1',
            'category_id' => $this->faker->numberBetween($min = 1, $max = 5),
        ];
    }
}
