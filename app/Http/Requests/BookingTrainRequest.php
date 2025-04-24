<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class BookingTrainRequest extends FormRequest
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
     * https://laravel.com/docs/10.x/validation#form-request-validation
     */
    public function rules(): array
    {
        // https://laravel.com/docs/10.x/validation#available-validation-rules
        return [
            'name' => 'required|unique:trains',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|unique:trains,image_path',
            'description' => 'required|string',
            'departure_time' => 'required|before:now',
            'origin' => 'required|integer',
            'destination' => 'required|integer',
            'economy_price' => 'required|numeric',
            'executive_price' => 'required|numeric',
            'seats_available' => 'required|integer|max:500',
        ];
    }

    // https://laravel.com/docs/10.x/validation#performing-additional-validation-on-form-requests
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->input('origin') === $this->input('destination')) {
                    $validator->errors()->add('destination', 'Destination must be different from origin.');
                }
            }
        ];
    }
}
