<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'airline' => $this->airline,
            'image' => $this->image,
            'flightNumber' => (string) $this->flight_number,
            'departureAirport' => $this->departure_airport,
            'arrivalAirport' => $this->arrival_airport,
            "departureTime" => $this->departure_time,
            'arrivalTime' => $this->arrival_time,
            "price" => $this->price,
        ];
    }
}
