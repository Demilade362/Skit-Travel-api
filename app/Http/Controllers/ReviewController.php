<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\Destination;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function showReview(Destination $destination)
    {
        return $destination->reviews;
    }


    public function storeReview(Destination $destination, Request $request)
    {
        $request->validate([
            'rating' => "required",
            "comment" => "string|required"
        ]);

        $destination->reviews()->create([
            "rating" => $request->rating,
            "comment" => $request->comment
        ]);

        return response([
            "message" => "Review Added"
        ]);
    }
}
