<?php

namespace App\Http\Controllers;

use App\Events\NotifyUser;
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

        event(new NotifyUser(auth()->user(), 'Your Flight Has Been Booked'));

        return response(
            [
                "message" => "Your Flight Has been Booked Successfully"
            ]
        );
    }

    public function updateBookFlight($id, Request $request)
    {
        $request->validate(
            [
                'passenger_name' => 'string',
                'passenger_email' => 'string',
                'seat_number' => 'string',
                'booking_status' => 'string'
            ]
        );

        $flight = Flight::findorFail($id);
        $flight->update($request->all());

        event(new NotifyUser(auth()->user(), 'Your Flight Details Has Been Updated Succesfully'));
        return response(
            [
                "message" => "Your Flight Details Has Been Updated Succesfully"
            ]
        );
    }
}
