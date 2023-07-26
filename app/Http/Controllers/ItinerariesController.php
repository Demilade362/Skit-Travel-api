<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItineraryRequest;
use App\Http\Resources\ItinerariesResource;
use App\Models\Itineraries;
use Illuminate\Http\Request;

class ItinerariesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ItinerariesResource::collection(Itineraries::paginate(6)->load('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItineraryRequest $request)
    {
        $request->validated();

        Itineraries::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description
        ]);

        return response([
            "message" => "Itinerary Created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Itineraries $itinerary)
    {
        return new ItinerariesResource($itinerary);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Itineraries $itinerary)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => "min:6",
            'start_date' => "date",
            'end_date' => 'date',
            "description" => 'min:10'
        ]);

        $itinerary->update([
            "user_id" => $request->user_id,
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            "description" => $request->description
        ]);

        return response(
            [
                "message" => "$itinerary->title Updated"
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Itineraries $itinerary)
    {
        $itinerary->delete();

        return response(
            ['message' => 'Itinerary Deleted'],
        );
    }
}
