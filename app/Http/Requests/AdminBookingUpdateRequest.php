<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminBookingUpdateRequest extends FormRequest
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
            'checkin_date' => ['required', 'date'],
            'checkout_date' => ['required', 'date'],
            'arrival_time' => ['required', 'string'],
            'no_of_adults' => ['required', 'integer'],
            'no_of_children' => ['required', 'integer'],
            'user_title' => ['required', 'string'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address_line_one' => ['required', 'string', 'max:500'],
            'address_line_two' => ['nullable', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'tel', 'max:11'],
            'email_address' => ['required', 'email', 'max:255']
        ];
    }
}
