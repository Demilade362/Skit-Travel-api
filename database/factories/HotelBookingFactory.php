<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HotelBooking>
 */
class HotelBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel_id' => rand(1, count(Hotel::all())),
            'guest_name' => $this->faker->name(),
            'guest_email' => $this->faker->email(),
            'check_in_date' => $this->faker->date(),
            'check_out_date' => $this->faker->date(),
            'room_type' => $this->faker->randomElement(['single', 'double', 'suite']),
            'num_guests' => $this->faker->randomNumber(1),
            'total_amount' => $this->faker->randomFloat(1, 1, 700000),
            'payment_status' => $this->faker->randomElement(['paid', 'pending'])
        ];
    }
}
