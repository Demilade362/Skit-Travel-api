<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline',
        'flight_number',
        'departure_airport',
        'arrival_airport',
        'departure_time',
        'arrival_time',
        'price'
    ];
}
