<?php

namespace App\Http\Controllers;

use App\Events\NotifyUser;
use App\Http\Requests\HotelRequest;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return HotelResource::collection(Hotel::paginate(6));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRequest $request)
    {
        $role = Role::findByName('admin', 'web');
        $user = $request->user();
        if (!($user->hasRole('admin') && $role->hasPermissionTo('create hotel'))) {
            abort(403, 'You are not Authorized');
        }

        $request->validated();

        Hotel::create([
            "name" => $request->input('name'),
            "location" => $request->input('location'),
            "rating" => $request->input('rating'),
            "price_per_night" => $request->input('price_per_night'),
            "available_rooms" => $request->input('available_rooms')
        ]);

        event(new NotifyUser(auth()->user(), 'Hotel Details Added'));

        return response(
            [
                "message" => "Hotel Added to Record"
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return new HotelResource($hotel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $role = Role::findByName('admin', 'web');
        $user = $request->user();
        if (!($user->hasRole('admin') && $role->hasPermissionTo('update hotel'))) {
            abort(403, 'You are not Authorized');
        }

        $request->validate([
            'name' => 'min:4',
            'location' => 'min:4',
            'rating' => 'double',
            'price_per_night' => 'integer',
            'available_rooms' => 'integer'
        ]);

        $hotel->update([
            "name" => $request->name,
            "location" => $request->location,
            "rating" => $request->rating,
            "price_per_night" => $request->price_per_night,
            "available_rooms" => $request->available_rooms
        ]);

        event(new NotifyUser(auth()->user(), "Details For $hotel->name has been updated"));

        return response(
            [
                'message' => "$hotel->name Successfully Updated"
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel, Request $request)
    {
        $role = Role::findByName('admin', 'web');
        $user = $request->user();
        if (!($user->hasRole('admin') && $role->hasPermissionTo('delete hotel'))) {
            abort(403, 'You are not Authorized');
        }

        $hotel->delete();

        event(new NotifyUser(auth()->user(), "You have Successfull Deleted $hotel->name hotel record"));

        return response([
            'message' => 'Hotel Data Deleted'
        ]);
    }
}
