<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutPageContentStoreRequest extends FormRequest
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
            'page_title' => ['required', 'string', 'max:255'],
            'page_slug' => ['nullable', 'slug', 'max:255'],
            'hero_banner_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'hero_banner_title' => ['required', 'string', 'max:255'],
            'about_banner_title' => ['required', 'string', 'max:255'],
            'about_banner_content' => ['required', 'max:10000'],
            'about_banner_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_content' => ['required', 'max:10000'],
            'banner_two_title' => ['required', 'string', 'max:255'],
            'banner_two_content' => ['required', 'max:10000'],
            'banner_two_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp']
        ];
    }
}
