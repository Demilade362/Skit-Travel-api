<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ItinerariesController;
use App\Http\Controllers\ReviewController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Private Routes

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/destination/{id}/reviews", [ReviewController::class, 'showReview'])->name("review.show");
    Route::post("/destination/{id}/reviews", [ReviewController::class, 'storeReview'])->name("review.store");
    Route::apiResource('itineraries', ItinerariesController::class);
    Route::apiResource('hotel', HotelController::class);
    Route::apiResource('flight', FlightController::class);
    Route::post('/destination/search', [DestinationController::class, 'search'])->name('destination.search');
    Route::apiResource('destination', DestinationController::class);
    Route::get('/user', function (Request $request) {
        Route::post('/logout', [AuthController::class, 'logout']);
        return $request->user();
    });
});
