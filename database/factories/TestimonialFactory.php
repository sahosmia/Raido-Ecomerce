<?php

namespace Database\Factories;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Testimonial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'img' => 'testimonial.jpg',
            'is_active' => $this->faker->boolean,
            'added_by' => User::inRandomOrder()->first()?->id ?? User::factory()->create()->id,
        ];
    }
}