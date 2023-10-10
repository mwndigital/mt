<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'room_type' => ['required', 'string', 'max:255'],
            'adult_cap' => ['required', 'integer'],
            'child_cap' => ['required', 'integer'],
            'bathroom_type' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'short_description' => ['required'],
            'featured_image' => ['required', 'image', 'mimes:jpg,jpeg,webp,png'],
            'price_per_night_double' => ['required'],
            'price_per_night_single' => ['required'],
        ];
    }
}
