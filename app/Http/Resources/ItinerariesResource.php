<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItinerariesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => (string) $this->id,
            "userId" => $this->user_id,
            "username" => $this->whenLoaded('user', $this->user->name),
            "title" => $this->title,
            "startDate" => $this->start_date,
            "endDate" => $this->end_date,
            "description" => $this->description
        ];
    }
}
