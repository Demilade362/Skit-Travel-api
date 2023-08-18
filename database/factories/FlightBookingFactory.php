<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FlightBooking>
 */
class FlightBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "flight_id" => rand(1, count(Flight::all())),
            'passenger_name' => $this->faker->name(),
            'passenger_email' => $this->faker->email(),
            'seat_number' => $this->faker->randomAscii(),
            'booking_status' => $this->faker->randomElement(['confirmed', 'pending', 'canceled']),
        ];
    }
}
