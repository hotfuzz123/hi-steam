<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'score' => $this->faker->numberBetween($min = 4, $max = 10),
            'comment' => $this->faker->randomElement(['Tuyệt vời' ,'Tốt', 'Tạm được', 'Quá tệ']),
            'homework_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
