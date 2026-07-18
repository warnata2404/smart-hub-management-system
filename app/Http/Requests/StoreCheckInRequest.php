<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCheckInRequest extends FormRequest
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
            'booking_id' => [
                'required',
                'integer',
                'exists:bookings,id',
            ],

            'booking_item_id' => [
                'required',
                'integer',
                'exists:booking_items,id',
            ],

            'checked_in_by' => [
                'required',
                'integer',
                'exists:users,id',
            ],

            'returned_quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'condition' => [
                'required',
                Rule::in([
                    'good',
                    'damaged',
                    'maintenance',
                ]),
            ],

            'checked_in_at' => [
                'required',
                'date',
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
            'booking_id.required' => 'Booking is required.',
            'booking_id.exists' => 'Selected booking does not exist.',

            'booking_item_id.required' => 'Booking item is required.',
            'booking_item_id.exists' => 'Selected booking item does not exist.',

            'checked_in_by.required' => 'Checked-in by is required.',
            'checked_in_by.exists' => 'Selected user does not exist.',

            'returned_quantity.required' => 'Returned quantity is required.',
            'returned_quantity.integer' => 'Returned quantity must be an integer.',
            'returned_quantity.min' => 'Returned quantity must be at least 1.',

            'condition.required' => 'Condition is required.',
            'condition.in' => 'Invalid equipment condition.',

            'checked_in_at.required' => 'Check-in date and time is required.',
            'checked_in_at.date' => 'Check-in date and time must be a valid date.',

            'notes.string' => 'Notes must be a valid string.',
        ];
    }
}
