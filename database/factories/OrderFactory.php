<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderBillingDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sub_total = $this->faker->randomFloat(2, 50, 1000);
        $discount = $this->faker->randomFloat(2, 0, $sub_total / 4);
        $total = $sub_total - $discount;

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory()->create()->id,
            'sub_total' => $sub_total,
            'discount' => $discount,
            'total' => $total,
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'declined', 'cancelled']),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            OrderDetail::factory()->count($this->faker->numberBetween(1, 5))->create([
                'order_id' => $order->id,
            ]);
            OrderBillingDetail::factory()->create([
                'order_id' => $order->id,
            ]);
        });
    }
}