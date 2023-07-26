<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Itineraries>
 */
class ItinerariesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => rand(1, count(User::all())),
            "title" => $this->faker->sentence(),
            "start_date" => $this->faker->date(),
            "end_date" => $this->faker->date(),
            "description" => $this->faker->realText()
        ];
    }
}
