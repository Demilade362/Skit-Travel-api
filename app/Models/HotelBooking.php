<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        "hotel_id",
        'guest_name',
        'guest_email',
        'check_in_date',
        'check_out_date',
        'room_type',
        'num_guest',
        'total_amount',
        'payment_status',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
