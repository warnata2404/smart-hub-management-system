<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEquipmentRequest extends FormRequest
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
            'code' => [
                'required',
                'string',
                'max:30',
                'unique:equipments,code',
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:0',
            ],

            'available_quantity' => [
                'required',
                'integer',
                'min:0',
                'lte:quantity',
            ],

            'condition' => [
                'required',
                Rule::in([
                    'good',
                    'damaged',
                    'maintenance',
                ]),
            ],

            'status' => [
                'required',
                Rule::in([
                    'available',
                    'unavailable',
                ]),
            ],
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'code.required' => 'Equipment code is required.',
            'code.unique' => 'Equipment code already exists.',

            'name.required' => 'Equipment name is required.',

            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity cannot be negative.',

            'available_quantity.required' => 'Available quantity is required.',
            'available_quantity.integer' => 'Available quantity must be an integer.',
            'available_quantity.min' => 'Available quantity cannot be negative.',
            'available_quantity.lte' => 'Available quantity cannot exceed quantity.',

            'condition.required' => 'Equipment condition is required.',
            'condition.in' => 'Invalid equipment condition.',

            'status.required' => 'Equipment status is required.',
            'status.in' => 'Invalid equipment status.',
        ];
    }
}
