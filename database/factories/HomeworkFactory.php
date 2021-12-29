<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HomeworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'file' => 'https://player.vimeo.com/video/270134945',
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'lesson_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
