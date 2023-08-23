<?php

namespace App\Http\Controllers;

use App\Events\NotifyUser;
use App\Http\Requests\FlightRequest;
use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
        $role = Role::findByName('admin', 'web');
        $user = $request->user();
        if (!($user->hasRole('admin') && $role->hasPermissionTo('create flight'))) {
            abort(403, 'You are not Authorized');
        }

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

        event(new NotifyUser(auth()->user(), 'You Just Added a New Flight Details'));

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
        $role = Role::findByName('admin', 'web');
        $user = $request->user();
        if (!($user->hasRole('admin') && $role->hasPermissionTo('update flight'))) {
            abort(403, 'You are not Authorized');
        }

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

        event(new NotifyUser(auth()->user(), "You just updated the flight Details for $flight->airpline"));

        return response([
            'message' => "$request->airline Record Has Been Updated Successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight, Request $request)
    {
        $role = Role::findByName('admin', 'web');
        $user = $request->user();
        if (!($user->hasRole('admin') && $role->hasPermissionTo('delete flight'))) {
            abort(403, 'You are not Authorized');
        }

        $flight->delete();

        event(new NotifyUser(auth()->user(), 'Flight Details Deleted'));

        return response([
            'message' => "$flight->airline Record Deleted"
        ]);
    }
}
