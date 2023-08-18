<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FlightBookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ItinerariesController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SocialiteController;
use App\Mail\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Public Routes

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::controller(SocialiteController::class)->group(
    function () {
        Route::get('/google/auth', 'googleLogin');
        Route::get('/auth/callback/google', 'googleCallback');
    }
);

//Private Routes

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(DestinationController::class)->group(function () {
        Route::post('/destination/search', 'search')->name('destination.search');
    });
    Route::apiResource('destination', DestinationController::class);

    Route::controller(ReviewController::class)->group(function () {
        Route::get("/destination/{destination}/reviews", 'showReview')->name("review.show");
        Route::post("/destination/{destination}/reviews", 'storeReview')->name("review.store");
    });
    Route::post('/book/hotel', [HotelBookingController::class, 'bookHotel']);
    Route::post('/book/flights', [FlightBookingController::class, 'bookFlight']);
    Route::apiResource('itineraries', ItinerariesController::class);
    Route::apiResource('hotel', HotelController::class);
    Route::apiResource('flight', FlightController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
