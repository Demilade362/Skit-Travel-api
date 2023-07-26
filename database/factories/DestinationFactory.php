<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city(),
            'description' => $this->faker->realText($maxNbChars = 150),
            'location' => $this->faker->state(),
            'image' => $this->faker->imageUrl($width = 640, $height = 480, 'city'),
            'rating' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 3, $max = 5),
        ];
    }
}
