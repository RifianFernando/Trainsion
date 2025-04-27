<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingTicketRequest extends FormRequest
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
            'trainID' => 'required|integer',
            'userData' => 'required|array',
            'userData.*.name' => 'required|string',
            'userData.*.email' => 'required|email:rfc',
            'userData.*.phone_number' => 'required|string|max:15',
            'userData.*.class' => ['required', Rule::in(['Economy', 'Executive'])],
        ];
    }

    public function messages()
    {
        return [
            'userData.*.class.in' => 'class is between executive class or economy class'
        ];
    }
}
