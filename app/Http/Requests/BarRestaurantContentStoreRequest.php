<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarRestaurantContentStoreRequest extends FormRequest
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
            'hero_banner_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,svg'],
            'banner_one_title' => ['nullable', 'title', 'max:255'],
            'banner_one_content' => ['required', 'max:10000'],
            'banner_one_big_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_small_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'separator_banner_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_two_title' => ['required', 'string', 'max:255'],
            'banner_two_content' => ['required', 'max:10000'],
            'banner_two_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'book_stay_banner_title' => ['required', 'string', 'max:255'],
            'book_stay_banner_content' => ['required', 'max:10000'],
            'book_stay_banner_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'page_description' => ['nullable', 'max:300'],
            'page_keywords' => ['nullable', 'max:300'],
            'page_type' => ['nullable', 'string', 'max:255'],
            'page_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp']
        ];
    }
}
