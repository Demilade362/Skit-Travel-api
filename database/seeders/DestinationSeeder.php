<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Destination::factory(20)->create()->each(function ($destination) {
            $destination->reviews()->create([
                'rating' => fake()->randomFloat(1, 1, 5),
                'comment' => fake()->realText()
            ]);
        });
    }
}
