<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cupon>
 */
class CuponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'code' => $this->faker->unique()->regexify('[A-Z0-9]{8}'),
            'discount' => $this->faker->randomFloat(2, 5, 50),
            'end_cupon' => $this->faker->dateTimeBetween('now', '+1 year'),
            'action' => $this->faker->boolean,
            'added_by' => 1,
        ];
    }
}
