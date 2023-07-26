<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FlightResource::collection(Flight::paginate(6));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FlightRequest $request)
    {
        $request->validated();

        Flight::create([
            'airline' => $request->airline,
            'flight_number' => $request->flight_number,
            'departure_airport' => $request->departure_airport,
            'arrival_airport' => $request->arrival_airport,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'price' => $request->price
        ]);

        return response([
            'message' => "Flight Record Added Successfully",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        return new FlightResource($flight);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        $request->validate(
            [
                'airline' => 'min:5',
                'departure_airport' => 'min:5',
                'arrival_airport' => 'min:5',
                'departure_time' => 'date',
                'arrival_time' => 'date',
                'price' => 'integer',
            ]
        );

        $flight->update([
            'airline' => $request->airline,
            'flight_number' => $request->flight_number,
            'departure_airport' => $request->departure_airport,
            'arrival_airport' => $request->arrival_airport,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'price' => $request->price
        ]);

        return response([
            'message' => "$request->airline Record Has Been Updated Successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        $flight->delete();

        return response([
            'message' => "$flight->airline Record Deleted"
        ]);
    }
}
