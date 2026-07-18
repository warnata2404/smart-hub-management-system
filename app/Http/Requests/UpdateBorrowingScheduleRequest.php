<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBorrowingScheduleRequest extends FormRequest
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
            'equipment_id' => [
                'required',
                'integer',
                'exists:equipments,id',
            ],

            'borrow_date' => [
                'required',
                'date',
            ],

            'return_date' => [
                'required',
                'date',
                'after_or_equal:borrow_date',
            ],

            'status' => [
                'required',
                Rule::in([
                    'available',
                    'reserved',
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
            'equipment_id.required' => 'Equipment is required.',
            'equipment_id.exists' => 'Selected equipment does not exist.',

            'borrow_date.required' => 'Borrow date is required.',
            'borrow_date.date' => 'Borrow date must be a valid date.',

            'return_date.required' => 'Return date is required.',
            'return_date.date' => 'Return date must be a valid date.',
            'return_date.after_or_equal' => 'Return date must be on or after the borrow date.',

            'status.required' => 'Status is required.',
            'status.in' => 'Invalid borrowing schedule status.',
        ];
    }
}
