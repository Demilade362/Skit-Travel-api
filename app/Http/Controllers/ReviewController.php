<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function showReview($id)
    {
        try {
            $destination = Destination::findorFail($id)->reviews;
            return $destination;
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function storeReview($id, Request $request)
    {
        $request->validate([
            'rating' => "required",
            "comment" => "string|required"
        ]);
        $destination = Destination::findorFail($id);

        $destination->reviews()->create([
            "rating" => $request->rating,
            "comment" => $request->comment
        ]);

        return response([
            "message" => "Review Added"
        ]);
    }
}
