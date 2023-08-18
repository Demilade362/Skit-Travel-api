<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FlightBooking;
use App\Models\HotelBooking;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([DestinationSeeder::class, FlightSeeder::class, HotelSeeder::class, ItinerariesSeeder::class]);

        FlightBooking::factory(10)->create();
        HotelBooking::factory(10)->create();
    }
}
