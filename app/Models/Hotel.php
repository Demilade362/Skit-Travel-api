<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'rating',
        'price_per_night',
        'available_rooms',
    ];

    public function hotelBooking(): HasMany
    {
        return $this->hasMany(HotelBooking::class);
    }
}
