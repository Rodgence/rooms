<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class BookingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_id' => 'required|exists:rooms,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:10',
        ];
    }

    /**
     * Get the custom error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'room_id.required' => 'Please select a room',
            'room_id.exists' => 'Selected room does not exist',
            'full_name.required' => 'Full name is required',
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'phone.required' => 'Phone number is required',
            'check_in.required' => 'Check-in date is required',
            'check_in.date' => 'Please enter a valid check-in date',
            'check_in.after_or_equal' => 'Check-in date cannot be in the past',
            'check_out.required' => 'Check-out date is required',
            'check_out.date' => 'Please enter a valid check-out date',
            'check_out.after' => 'Check-out date must be after check-in date',
            'guests.required' => 'Number of guests is required',
            'guests.integer' => 'Number of guests must be a number',
            'guests.min' => 'At least 1 guest is required',
            'guests.max' => 'Maximum 10 guests allowed',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $room = \App\Models\Room::find($this->room_id);
            
            if ($room && $this->guests > $room->max_guests) {
                $validator->errors()->add('guests', 'Number of guests exceeds the maximum capacity for this room');
            }
            
            // Check for overlapping bookings
            if ($this->room_id && $this->check_in && $this->check_out) {
                $checkIn = Carbon::parse($this->check_in);
                $checkOut = Carbon::parse($this->check_out);
                
                $existingBooking = \App\Models\Booking::where('room_id', $this->room_id)
                    ->where(function ($query) use ($checkIn, $checkOut) {
                        $query->whereBetween('check_in', [$checkIn, $checkOut])
                            ->orWhereBetween('check_out', [$checkIn, $checkOut])
                            ->orWhere(function ($query) use ($checkIn, $checkOut) {
                                $query->where('check_in', '<=', $checkIn)
                                    ->where('check_out', '>=', $checkOut);
                            });
                    })
                    ->whereNotIn('status', ['cancelled'])
                    ->exists();
                    
                if ($existingBooking) {
                    $validator->errors()->add('check_in', 'This room is not available for the selected dates');
                }
            }
        });
    }
}
