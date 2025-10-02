<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
use App\Models\Subcategory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subcategory = Subcategory::inRandomOrder()->first() ?? Subcategory::factory()->create();

        return [
            'name' => $this->faker->words(3, true),
            'des' => $this->faker->paragraph,
            'img' => null,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'discount' => $this->faker->randomFloat(2, 5, 50),
            'notification_quantity' => $this->faker->numberBetween(1, 10),
            'action' => $this->faker->boolean,
            'best_sell' => $this->faker->boolean,
            'category' => $subcategory->category,
            'subcategory' => $subcategory->id,
            'added_by' => 1,
        ];
    }
}
