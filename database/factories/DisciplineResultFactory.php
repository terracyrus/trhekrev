<?php

namespace Database\Factories;

use App\Models\Discipline;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DisciplineResult>
 */
class DisciplineResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'discipline_id' => Discipline::factory(),
            'points' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
