<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookingRequest extends FormRequest
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
        $booking = $this->route('booking');

        $bookingId = is_object($booking)
            ? $booking->id
            : $booking;

        return [
            'booking_code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('bookings', 'booking_code')->ignore($bookingId),
            ],

            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],

            'borrowing_schedule_id' => [
                'required',
                'integer',
                'exists:borrowing_schedules,id',
            ],

            'booking_date' => [
                'required',
                'date',
            ],

            'return_date' => [
                'required',
                'date',
                'after_or_equal:booking_date',
            ],

            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'approved',
                    'borrowed',
                    'completed',
                    'cancelled',
                ]),
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'booking_code.required' => 'Booking code is required.',
            'booking_code.unique' => 'Booking code already exists.',
            'booking_code.max' => 'Booking code may not be greater than 30 characters.',

            'user_id.required' => 'User is required.',
            'user_id.exists' => 'Selected user does not exist.',

            'borrowing_schedule_id.required' => 'Borrowing schedule is required.',
            'borrowing_schedule_id.exists' => 'Selected borrowing schedule does not exist.',

            'booking_date.required' => 'Booking date is required.',
            'booking_date.date' => 'Booking date must be a valid date.',

            'return_date.required' => 'Return date is required.',
            'return_date.date' => 'Return date must be a valid date.',
            'return_date.after_or_equal' => 'Return date must be on or after the booking date.',

            'status.required' => 'Status is required.',
            'status.in' => 'Invalid booking status.',
        ];
    }
}
