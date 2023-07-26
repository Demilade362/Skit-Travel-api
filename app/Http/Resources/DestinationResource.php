<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
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
            'description' => $this->description,
            'location' => $this->location,
            'image' => $this->image,
            'rating' => $this->rating,
            'reviews' => $this->whenLoaded('reviews', $this->reviews),
        ];
    }
}
