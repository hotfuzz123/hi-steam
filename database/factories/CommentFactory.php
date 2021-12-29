<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->country,
            'heart' => $this->faker->numberBetween($min = 10, $max = 500),
            'lesson_id' => '1',
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
