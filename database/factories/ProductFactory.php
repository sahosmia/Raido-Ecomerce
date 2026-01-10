<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subcategory = Subcategory::inRandomOrder()->first();
        if (!$subcategory) {
            $category = Category::factory()->create();
            $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);
        }

        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->paragraph,
            'img' => null,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'discount' => $this->faker->randomFloat(2, 5, 50),
            'notification_quantity' => $this->faker->numberBetween(1, 10),
            'is_active' => $this->faker->boolean,
            'best_sell' => $this->faker->boolean,
            'category_id' => $subcategory->category_id,
            'subcategory_id' => $subcategory->id,
            'added_by' => User::inRandomOrder()->first()?->id ?? User::factory()->create()->id,
        ];
    }
}