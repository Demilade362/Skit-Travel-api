<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'location' => $this->faker->city(),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'price_per_night' => $this->faker->numberBetween(300, 5000),
            'available_rooms' => $this->faker->numberBetween(1, 20),
            'image' => $this->faker->imageUrl($word = 'hotel'),
        ];
    }
}
