<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'airline' => $this->faker->company(),
            'flight_number' => $this->faker->randomNumber(),
            'departure_airport' => $this->faker->company(),
            'arrival_airport' => $this->faker->company(),
            'departure_time' => $this->faker->date(),
            'arrival_time' => $this->faker->date(),
            'price' => $this->faker->randomNumber(4),
            'image' => $this->faker->imageUrl($word = "airline"),
        ];
    }
}
