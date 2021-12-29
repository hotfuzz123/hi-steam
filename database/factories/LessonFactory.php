<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'tool' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'thumbnail' => $this->faker->imageUrl($width = 640, $height = 480),
            'video_link' => 'https://player.vimeo.com/video/270134945',
            'view' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'status' => $this->faker->randomElement(['active' ,'inactive']),
            'admin_id' => '1',
            'course_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
