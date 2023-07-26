<?php

namespace Database\Seeders;

use App\Models\Itineraries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItinerariesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Itineraries::factory(20)->create();
    }
}
