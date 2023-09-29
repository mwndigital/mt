<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\BarPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $heroBannerBgImagePath = NULL;
        $bannerOneImage = NULL;
        $bannerOneImagePath = NULL;
        $bannerTwoImage = NULL;
        $bannerTwoImagePath = NULL;
        $bannerThreeImage = NULL;
        $bannerThreeImagePath = NULL;
        $bookBannerImage = NULL;
        $bookBannerImagePath = NULL;
        $seoImage = NULL;
        $seoImagePath = NULL;

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_content' => ['required', 'string'],
            'hero_banner_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_title' => ['required', 'string', 'max:255'],
            'banner_one_content' => ['required', 'string'],
            'banner_one_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_two_title' => ['required', 'string', 'max:255'],
            'banner_two_content' => ['required', 'string'],
            'banner_two_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_three_title' => ['required', 'string', 'max:255'],
            'banner_three_content' => ['required', 'string'],
            'banner_three_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'book_banner_title' => ['required', 'string', 'max:255'],
            'book_banner_content' => ['required', 'string'],
            'book_banner_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'book_banner_button_content' => ['required', 'string'],
            'book_banner_button_link' => ['required', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp']
        ]);

        if($request->hasFile('hero_banner_background_image')){
            $heroBannerBgImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'.$heroBannerBgImage->getClientOriginalName();
            $folder = 'public/pages/barpage';

            $heroBannerBgImagePath = $heroBannerBgImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_one_image')){
            $bannerOneImage = $request->file('banner_one_image');
            $fileName = time().'_'.$bannerOneImage->getClientOriginalName();
            $folder = 'public/pages/barpage';

            $bannerOneImagePath = $bannerOneImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_two_image')) {
            $bannerTwoImage = $request->file('banner_two_image');
            $fileName = time().'_'.$bannerTwoImage->getClientOriginalName();
            $folder = 'public/pages/barpage';

            $bannerTwoImagePath = $bannerTwoImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_three_image')){
            $bannerThreeImage = $request->file('banner_three_image');
            $fileName = time().'_'.$bannerThreeImage->getClientOriginalName();
            $folder = 'public/pages/barpage';

            $bannerThreeImagePath = $bannerThreeImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('book_banner_background_image')){
            $bookBannerImage = $request->file('book_banner_background_image');
            $fileName = time().'_'.$bookBannerImage->getClientOriginalName();
            $folder = 'public/pages/barpage';

            $bookBannerImagePath = $bookBannerImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('seo_image')){
            $seoImage = $request->file('seo_image');
            $fileName = time().'_'.$seoImage->getClientOriginalName();
            $folder = 'public/pages/barpage';

            $seoImagePath = $seoImage->storeAs($folder, $fileName);
        }

        BarPageContent::create([
            'page_title' => $validated['page_title'],
            'slug' => Str::slug($validated['page_title']),
            'hero_title' => $validated['hero_title'],
            'hero_content' => $validated['hero_content'],
            'hero_banner_background_image' => $heroBannerBgImagePath,
            'banner_one_title' => $validated['banner_one_title'],
            'banner_one_content' => $validated['banner_one_content'],
            'banner_one_image' => $bannerOneImagePath,
            'banner_two_title' => $validated['banner_two_title'],
            'banner_two_content' => $validated['banner_two_content'],
            'banner_two_image' => $bannerTwoImagePath,
            'banner_three_title' => $validated['banner_three_title'],
            'banner_three_content' => $validated['banner_three_content'],
            'banner_three_image' => $bannerThreeImagePath,
            'book_banner_title' => $validated['book_banner_title'],
            'book_banner_content' => $validated['book_banner_content'],
            'book_banner_background_image' => $bookBannerImagePath,
            'book_banner_button_content' => $validated['book_banner_button_content'],
            'book_banner_button_link' => $validated['book_banner_button_link'],
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'seo_keywords' => $validated['seo_keywords'],
            'seo_image' => $seoImagePath,
        ]);

        return redirect()->back()->with('success', 'Bar page content added successfully');
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
