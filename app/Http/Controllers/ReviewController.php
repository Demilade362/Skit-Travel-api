<?php

namespace App\Http\Controllers;

use App\Events\NotifyUser;
use App\Http\Resources\ReviewResource;
use App\Models\Destination;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function showReview(Destination $destination)
    {
        return $destination->reviews->map(function ($review) {
            return [
                'id' => $review['id'],
                'rating' => $review['rating'],
                'comment' => $review['comment'],
                'createdAt' => $review['created_at']->diffForHumans()
            ];
        });
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

        event(new NotifyUser(auth()->user(), "Your Review Has Been Posted"));

        return response([
            "message" => "Review Added"
        ]);
    }
}
