<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cart::class;

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
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Cart $cart) {
            // Ensure the (user_id, product_id) pair is unique
            while (Cart::where('user_id', $cart->user_id)->where('product_id', $cart->product_id)->exists()) {
                $cart->user_id = User::inRandomOrder()->first()?->id ?? User::factory()->create()->id;
                $cart->product_id = Product::inRandomOrder()->first()?->id ?? Product::factory()->create()->id;
            }
        });
    }
}