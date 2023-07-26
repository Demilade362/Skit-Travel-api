<?php

namespace App\Http\Controllers;

use App\Http\Resources\DestinationResource;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DestinationResource::collection(Destination::paginate(6)->load('reviews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6|string',
            'description' => 'required|string|min:15',
            'location' => 'required|string',
            'image' => 'required',
            'rating' => 'required'
        ]);

        Destination::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'image' => $request->image,
            'rating' => $request->rating
        ]);

        return response([
            'message' => "Destination Added"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        return new DestinationResource($destination);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'string|min:6',
            'description' => 'string|min:15',
            'location' => 'string',
            'rating' => 'integer'
        ]);

        $destination->update([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'image' => $request->image,
            'rating' => $request->rating,
        ]);

        return response(
            [
                'message' => 'Destination Updated'
            ]
        );
    }

    /**
     * Search For a specified resource from storage
     */

    public function search(Request $request)
    {
        $location = $request->query('query');
        $results = Destination::where('location', 'like', '%' . $location . '%')->get();

        return response(
            $results
        );
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();

        return response([
            'message' => "Destination Deleted"
        ]);
    }
}
