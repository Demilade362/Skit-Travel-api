<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightBookingController extends Controller
{
    public function bookFlight(Request $request)
    {
        $request->validate(
            [
                'flight_id' => 'required',
                'passenger_name' => 'required|string',
                'passenger_email' => 'required|string',
                'seat_number' => 'required|string',
                'booking_status' => 'required|string'
            ]
        );

        Flight::create([
            $request->all()
        ]);

        return response(
            [
                "message" => "Your Flight Has been Booked Successfully"
            ]
        );
    }
}
