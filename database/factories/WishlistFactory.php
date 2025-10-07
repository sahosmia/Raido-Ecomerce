<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishlistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wishlist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Wishlist $wishlist) {
            // Ensure the (user_id, product_id) pair is unique
            while (Wishlist::where('user_id', $wishlist->user_id)->where('product_id', $wishlist->product_id)->exists()) {
                $wishlist->user_id = User::inRandomOrder()->first()?->id ?? User::factory()->create()->id;
                $wishlist->product_id = Product::inRandomOrder()->first()?->id ?? Product::factory()->create()->id;
            }
        });
    }
}