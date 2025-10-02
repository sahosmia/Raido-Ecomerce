<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
use App\Models\Category;

class SubcategoryFactory extends Factory
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
            'category' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'action' => $this->faker->boolean,
            'added_by' => 1, // Assumes a user with ID 1 exists
        ];
    }
}
