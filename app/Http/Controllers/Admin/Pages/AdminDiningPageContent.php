<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\DiningPageContent;
use App\Models\DiningPageFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminDiningPageContent extends Controller
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
        return view('admin.pages.dining-page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $heroBannerBackgroundImage = NULL;
        $heroBannerBackgroundImagePath = NULL;
        $bannerOneImage = NULL;
        $bannerOneImagePath = NULL;
        $bookBannerBackgroundImage = NULL;
        $bookBannerBackgroundImagePath = NULL;
        $seoImage = NULL;
        $seoImagePath = NULL;

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_content' => ['required'],
            'hero_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_title' => ['required', 'string', 'max:255'],
            'banner_one_content' => ['required'],
            'banner_one_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'images' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'book_banner_title' => ['required', 'string', 'max:255'],
            'book_banner_content' => ['required'],
            'book_banner_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'book_banner_button_content' => ['required', 'string', 'max:255'],
            'book_banner_button_link' => ['required', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
        ]);

        if($request->hasFile('hero_banner_background_image')){
            $heroBannerBackgroundImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'.$heroBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/diningpage';

            $heroBannerBackgroundImagePath = $heroBannerBackgroundImage->storeAs($folder,  $fileName);
        }
        if($request->hasFile('banner_one_image')){
            $bannerOneImage = $request->file('banner_one_image');
            $fileName = time().'_'.$bannerOneImage->getClientOriginalName();
            $folder = 'public/pages/diningpage';

            $bannerOneImagePath = $bannerOneImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('book_banner_background_image')) {
            $bookBannerBackgroundImage = $request->file('book_banner_background_image');
            $fileName = time().'_'.$bookBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/diningpage';

            $bookBannerBackgroundImagePath = $bookBannerBackgroundImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('seo_image')) {
            $seoImage = $request->file('seo_image');
            $fileName = time().'_'.$seoImage->getClientOriginalName();
            $folder = 'public/pages/dining';

            $seoImagePath = $seoImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('images')){
            foreach($request->file('images') as $image) {
                $fileName = time().'_'. $image->getClientOriginalName();
                $folder = 'public/pages/diningpage';

                $imagePath = $image->storeAs($folder, $fileName);

                //Create DB rec
                $diningPageImage = new DiningPageFile();
                $diningPageImage->file_name = $fileName;
                $diningPageImage->original_name = $image->getClientOriginalName();
                $diningPageImage->file_path = $imagePath;
                $diningPageImage->save();
            }
        }

        DiningPageContent::create([
            'page_title' => $validated['page_title'],
            'slug' => Str::slug('page_title'),
            'hero_title' => $validated['hero_title'],
            'hero_content' => $validated['hero_content'],
            'hero_background_image' => $heroBannerBackgroundImagePath,
            'banner_one_title' => $validated['banner_one_title'],
            'banner_one_content' => $validated['banner_one_content'],
            'banner_one_image' => $bannerOneImagePath,
            'book_banner_title' => $validated['book_banner_title'],
            'book_banner_content' => $validated['book_banner_content'],
            'book_banner_background_image' => $bookBannerBackgroundImagePath,
            'book_banner_button_content' => $validated['book_banner_button_content'],
            'book_banner_button_link' => $validated['book_banner_button_link'],
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'seo_keywords' => $validated['seo_keywords'],
            'seo_image' => $seoImagePath,
        ]);

        return redirect()->back()->with('success', 'Dining page content has been added successfully');
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
        $content = DiningPageContent::findOrFail($id);
        $images = DiningPageFile::where('page_id', $id)->get();

        return view('admin.pages.dining-page.edit', compact('content', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $content = DiningPageContent::findOrFail($id);

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_content' => ['required'],
            'hero_background_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_title' => ['required', 'string', 'max:255'],
            'banner_one_content' => ['required'],
            'banner_one_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'images' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'book_banner_title' => ['required', 'string', 'max:255'],
            'book_banner_content' => ['required'],
            'book_banner_background_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'book_banner_button_content' => ['required', 'string', 'max:255'],
            'book_banner_button_link' => ['required', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
        ]);

        if($request->hasFile('hero_banner_background_image')){
            $heroBannerBackgroundImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'.$heroBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/diningpage';

            $heroBannerBackgroundImagePath = $heroBannerBackgroundImage->storeAs($folder,  $fileName);
        }
        else {
            $heroBannerBackgroundImagePath = $content->hero_background_image;
        }
        if($request->hasFile('banner_one_image')){
            $bannerOneImage = $request->file('banner_one_image');
            $fileName = time().'_'.$bannerOneImage->getClientOriginalName();
            $folder = 'public/pages/diningpage';

            $bannerOneImagePath = $bannerOneImage->storeAs($folder, $fileName);
        }
        else {
            $bannerOneImagePath = $content->banner_one_image;
        }
        if($request->hasFile('book_banner_background_image')) {
            $bookBannerBackgroundImage = $request->file('book_banner_background_image');
            $fileName = time().'_'.$bookBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/diningpage';

            $bookBannerBackgroundImagePath = $bookBannerBackgroundImage->storeAs($folder, $fileName);
        }
        else {
            $bookBannerBackgroundImagePath = $content->book_banner_background_image;
        }
        if($request->hasFile('seo_image')) {
            $seoImage = $request->file('seo_image');
            $fileName = time().'_'.$seoImage->getClientOriginalName();
            $folder = 'public/pages/dining';

            $seoImagePath = $seoImage->storeAs($folder, $fileName);
        }
        else {
            $seoImagePath = $content->seo_image;
        }
        if($request->hasFile('images')){
            foreach($request->file('images') as $image) {
                $fileName = time().'_'. $image->getClientOriginalName();
                $folder = 'public/pages/diningpage';

                $imagePath = $image->storeAs($folder, $fileName);

                //Create DB rec
                $diningPageImage = new DiningPageFile();
                $diningPageImage->file_name = $fileName;
                $diningPageImage->original_name = $image->getClientOriginalName();
                $diningPageImage->file_path = $imagePath;
                $diningPageImage->save();
            }
        }

        $content->update([
            'page_title' => $validated['page_title'],
            'slug' => Str::slug('page_title'),
            'hero_title' => $validated['hero_title'],
            'hero_content' => $validated['hero_content'],
            'hero_background_image' => $heroBannerBackgroundImagePath,
            'banner_one_title' => $validated['banner_one_title'],
            'banner_one_content' => $validated['banner_one_content'],
            'banner_one_image' => $bannerOneImagePath,
            'book_banner_title' => $validated['book_banner_title'],
            'book_banner_content' => $validated['book_banner_content'],
            'book_banner_background_image' => $bookBannerBackgroundImagePath,
            'book_banner_button_content' => $validated['book_banner_button_content'],
            'book_banner_button_link' => $validated['book_banner_button_link'],
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'seo_keywords' => $validated['seo_keywords'],
            'seo_image' => $seoImagePath,
        ]);

        return redirect()->back()->with('success', 'Dining page content has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
