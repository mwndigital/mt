<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomsContentUpdateStoreRequest extends FormRequest
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
            'page_title' => ['nullable', 'string', 'max:255'],
            'page_slug' => ['nullable', 'string', 'max:255'],
            'hero_banner_title' => ['required', 'string', 'max:255'],
            'hero_banner_background_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg'],
            'rooms_info_banner_content' => ['required', 'max:10000'],
            'page_description' => ['nullable', 'max:300'],
            'page_keywords' => ['nullable', 'max:300'],
            'page_type' => ['nullable', 'string', 'max:255'],
            'page_image' => ['nullable', 'image', 'mimes:jpg,jpeg,svg,webp']
        ];
    }
}
