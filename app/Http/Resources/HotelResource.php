<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->image,
            'rating' => $this->rating,
            'pricePerNight' => $this->price_per_night,
            'availableRooms' => $this->available_rooms
        ];
    }
}
