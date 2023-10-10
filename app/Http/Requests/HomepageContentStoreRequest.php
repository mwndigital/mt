<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomepageContentStoreRequest extends FormRequest
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
            'hero_banner_title' => ['required', 'string', 'max:255'],
            'hero_banner_content' => ['required', 'string', 'max:255'],
            'hero_banner_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,svg'],
            'banner_one_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,svg'],
            'banner_one_title' => ['required', 'string', 'max:255'],
            'banner_one_content' => ['required', 'max:10000'],
            'banner_one_button_link' => ['required', 'string', 'max:255'],
            'rooms_banner_sub_title' => ['required', 'string', 'max:255'],
            'rooms_banner_title' => ['required', 'string', 'max:255'],
            'rooms_banner_content' => ['required', 'max:10000'],
            'rooms_banner_button_link' => ['required', 'string', 'max:255'],
            'spend_night_banner_title' => ['required', 'string', 'max:255'],
            'spend_night_banner_content' => ['required', 'max:10000'],
            'spend_night_banner_button_link' => ['required', 'string', 'max:255'],
            'spend_night_banner_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,svg']
        ];
    }
}
