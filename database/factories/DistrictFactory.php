<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DistrictFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = District::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->city;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'division_id' => Division::inRandomOrder()->first()?->id ?? Division::factory()->create()->id,
        ];
    }
}