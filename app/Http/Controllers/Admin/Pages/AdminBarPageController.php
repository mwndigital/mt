<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\BarPageContent;
use Illuminate\Http\Request;

class AdminBarPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.bar-page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $heroBannerBgImage = NULL;
        $bannerOneImage = NULL;
        $bannerTwoImage = NULL;
        $bannerThreeImage = NULL;
        $bookBannerImage = NULL;

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_content' => ['required', 'string', 'max:15000'],
            'hero_banner_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_title' => ['required', 'string', 'max:255'],
            'banner_one_content' => ['required', 'string', 'mx:50000'],
            'banner_one_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_two_title' => ['required', 'string', 'max:255'],
            'banner_two_content' => ['required', 'string', 'mx:50000'],
            'banner_two_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_three_title' => ['required', 'string', 'max:255'],
            'banner_three_content' => ['required', 'string', 'mx:50000'],
            'banner_three_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'book_banner_title' => ['required', 'string', 'max:255'],
            'book_banner_content' => ['required', 'string', 'mx:50000'],
            'book_banner_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'book_banner_button_content' => ['required', 'string', 'max:255'],
            'book_banner_button_link' => ['required', 'string', 'max:255'],

        ]);

        BarPageContent::create([

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
