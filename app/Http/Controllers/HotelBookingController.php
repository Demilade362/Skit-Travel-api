<?php

namespace App\Http\Controllers;

use App\Events\NotifyUser;
use App\Models\HotelBooking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HotelBookingController extends Controller
{

    public function bookHotel(Request $request)
    {
        $request->validate(
            [
                "hotel_id" => 'required|integer',
                'guest_name' => 'required|string',
                'guest_email' => 'required|email',
                'check_in_date' => "required|date",
                'check_out_date' => 'required|date',
                'room_type' => ['required', 'string', Rule::in(['single', 'double', 'suite'])],
                'num_guests' => 'required|integer',
                'total_amount' => 'required|decimal:2',
                'payment_status' => ['required', Rule::in(['paid', 'pending'])],
            ]
        );

        HotelBooking::create($request->all());
        event(new NotifyUser(auth()->user(), "Your Hotel Has Been Booked Succesfully"));

        return response([
            'message' => 'You have successfully Book an Hotel'
        ]);
    }
}
