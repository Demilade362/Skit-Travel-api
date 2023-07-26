<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'airline' => 'required|min:5',
            'flight_number' => 'required',
            'departure_airport' => 'required|min:5',
            'arrival_airport' => 'required|min:5',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
            'price' => 'required|integer'
        ];
    }
}
