<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Order;
use App\Models\OrderBillingDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderBillingDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderBillingDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $district = District::inRandomOrder()->first() ?? District::factory()->create();

        return [
            'order_id' => Order::inRandomOrder()->first()?->id ?? Order::factory()->create()->id,
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'division_id' => $district->division_id,
            'district_id' => $district->id,
            'zip_code' => $this->faker->postcode,
        ];
    }
}