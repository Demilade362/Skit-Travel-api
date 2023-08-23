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

    public function updateBookHotel($id, Request $request)
    {
        $request->validate(
            [
                "hotel_id" => 'integer',
                'guest_name' => 'string',
                'guest_email' => 'email',
                'check_in_date' => "date",
                'check_out_date' => 'date',
                'room_type' => ['string', Rule::in(['single', 'double', 'suite'])],
                'num_guests' => 'integer',
                'total_amount' => 'decimal:2',
                'payment_status' => [Rule::in(['paid', 'pending'])],
            ]
        );

        $hotel = HotelBooking::findorFail($id);
        $hotel->update([
            $request->all()
        ]);

        return response([
            'message' => 'You have successfully updated your hotel booked details'
        ]);
    }
}
