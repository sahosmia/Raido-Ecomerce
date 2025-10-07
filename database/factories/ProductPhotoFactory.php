<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductPhoto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::inRandomOrder()->first()?->id ?? Product::factory()->create()->id,
            'img' => $this->faker->imageUrl(),
            'is_active' => $this->faker->boolean,
            'added_by' => User::inRandomOrder()->first()?->id ?? User::factory()->create()->id,
        ];
    }
}