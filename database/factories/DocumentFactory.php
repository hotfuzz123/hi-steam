<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
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
            'link' => 'https://player.vimeo.com/video/270134945',
            'status' => $this->faker->randomElement(['active' ,'inactive']),
            'admin_id' => '1',
            'lesson_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
