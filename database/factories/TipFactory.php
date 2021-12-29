<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'status' => $this->faker->randomElement(['active' ,'inactive']),
        ];
    }
}
