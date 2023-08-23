<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FlightBookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ItinerariesController;
use App\Http\Controllers\NotificationController;
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

# Register And Login Routes ( Authentication Routes )
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});


# Socialite Routes ( Google OAuth )
Route::controller(SocialiteController::class)->group(
    function () {
        Route::get('/google/auth', 'googleLogin');
        Route::get('/auth/callback/google', 'googleCallback');
    }
);

//Private Routes

Route::middleware('auth:sanctum')->group(function () {

    # Destination Routes
    Route::controller(DestinationController::class)->group(function () {
        Route::post('/destination/search', 'search')->name('destination.search');
    });
    Route::apiResource('destination', DestinationController::class);

    # Review Routes
    Route::controller(ReviewController::class)->group(function () {
        Route::get("/destination/{destination}/reviews", 'showReview')->name("review.show");
        Route::post("/destination/{destination}/reviews", 'storeReview')->name("review.store");
    });

    # Itineraries Routes
    Route::apiResource('itineraries', ItinerariesController::class);

    # Hotel Routes
    Route::apiResource('hotel', HotelController::class);
    Route::post('/book/hotel', [HotelBookingController::class, 'bookHotel']);

    # Flight Routes
    Route::apiResource('flight', FlightController::class);
    Route::post('/book/flights', [FlightBookingController::class, 'bookFlight']);


    # Notifications Routes
    Route::controller(NotificationController::class)->group(function () {
        Route::get('unreadNotification', 'unreadNotification');
        Route::get('/markNotificationAsRead', 'markAllRead');
        Route::get('/notifications', 'allNotification');
    });

    # User Route ( For Profile Page )
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    # Logout Route
    Route::post('/logout', [AuthController::class, 'logout']);
});
