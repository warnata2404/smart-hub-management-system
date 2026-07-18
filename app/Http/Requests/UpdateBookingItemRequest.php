<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingItemRequest extends FormRequest
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

            'equipment_id' => [
                'required',
                'integer',
                'exists:equipments,id',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'returned_quantity' => [
                'required',
                'integer',
                'min:0',
                'lte:quantity',
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

            'equipment_id.required' => 'Equipment is required.',
            'equipment_id.exists' => 'Selected equipment does not exist.',

            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity must be at least 1.',

            'returned_quantity.required' => 'Returned quantity is required.',
            'returned_quantity.integer' => 'Returned quantity must be an integer.',
            'returned_quantity.min' => 'Returned quantity cannot be negative.',
            'returned_quantity.lte' => 'Returned quantity cannot exceed quantity.',
        ];
    }
}
