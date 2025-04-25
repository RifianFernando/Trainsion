<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class BookingTrainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // https://laracasts.com/discuss/channels/general-discussion/formrequest-validation-and-json-responses
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
            'name' => 'required', // it's okay to be unique because 2 trains can had a different schedule and destination
            'train_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|unique:trains,train_image',
            'description' => 'required|string',
            'departure_time' => 'required|after:now',
            'origin_train_station_id' => 'required|exists:train_stations,id',
            'destination_train_station_id' => 'required|exists:train_stations,id|different:origin_train_station_id',
            'economy_price' => 'required|numeric|min:0',
            'executive_price' => 'required|numeric|min:0',
            'seats_available' => 'required|integer|min:1|max:500'
        ];
    }

    // https://laravel.com/docs/10.x/validation#performing-additional-validation-on-form-requests
    // public function after(): array
    // {
    //     return [
    //         function (Validator $validator) {
    //             if ($this->input('origin_train_station_id') == $this->input('origin_train_station_id')) {
    //                 $validator->errors()->add('destination', 'Destination must be different from origin.');
    //             }
    //         }
    //     ];
    // }
}
