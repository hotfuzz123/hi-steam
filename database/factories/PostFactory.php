<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'content' => $this->faker->text($maxNbChars = 200),
            'description' => $this->faker->text($maxNbChars = 200),
            'status' => $this->faker->randomElement(['public' ,'private']),
            'admin_id' => '1',
        ];
    }
}
