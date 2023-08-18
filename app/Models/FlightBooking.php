<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlightBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_id',
        'passenger_name',
        'passenger_email',
        'seat_number',
        'booking_status'
    ];

    public function flights(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }
}
