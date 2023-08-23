<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'msg' => $this->data['msg'],
            'createdAt' => $this->created_at->diffForHumans()
        ];
    }
}
