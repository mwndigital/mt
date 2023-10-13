<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\ContactPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminContactUsPageController extends Controller
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
        return view('admin.pages.contact-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $heroBackgroundImage = NULL;
        $heroBackgroundImagePath = NULL;
        $bannerOneImagesPath = [];
        $seoImage = NULL;
        $seoImagePath = NULL;

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_sub_title' => ['required'],
            'hero_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_title' => ['required', 'string', 'max:255'],
            'banner_one_content' => ['required'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
        ]);

        if ($request->hasFile('hero_background_image')) {
            $heroBackgroundImage = $request->file('hero_background_image');
            $fileName = time() . '_' . $heroBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/contact-us';

            $heroBackgroundImagePath = $heroBackgroundImage->storeAs($folder, $fileName);
        }

        if ($request->hasFile('banner_one_images')) {
            $bannerOneImages = $request->file('banner_one_images');

            foreach ($bannerOneImages as $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $folder = 'public/pages/contact-us';

                $bannerOneImagesPath[] = $folder . '/' . $fileName;
            }

        }

        if ($request->hasFile('seo_image')) {
            $seoImage = $request->file('seo_image');
            $fileName = time() . '_' . $seoImage->getClientOriginalName();
            $folder = 'public/pages/contact-us';

            $seoImagePath = $seoImage->storeAs($folder, $fileName);
        }

        ContactPageContent::create([
            'page_title' => $validated['page_title'],
            'slug' => Str::slug($validated['page_title']),
            'hero_title' => $validated['hero_title'],
            'hero_sub_title' => $validated['hero_sub_title'],
            'hero_background_image' => $heroBackgroundImagePath,
            'banner_one_title' => $validated['banner_one_title'],
            'banner_one_content' => $validated['banner_one_content'],
            'banner_one_images' => count($bannerOneImagesPath) > 0 ? json_encode($bannerOneImagesPath) : null,
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'seo_image' => $seoImagePath,
            'seo_keywords' => $validated['seo_keywords'],
        ]);

        return redirect()->back()->with('success', 'Contact page created successfully');
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
        $content = ContactPageContent::findOrFail($id);

        return view('admin.pages.contact-us.edit', compact('content'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $content = ContactPageContent::findOrFail($id);

        $heroBackgroundImage = NULL;
        $heroBackgroundImagePath = NULL;
        $bannerOneImagesPath = [];
        $seoImage = NULL;
        $seoImagePath = NULL;

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_sub_title' => ['required'],
            'hero_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_title' => ['required', 'string', 'max:255'],
            'banner_one_content' => ['required'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
        ]);

        if ($request->hasFile('hero_background_image')) {
            $heroBackgroundImage = $request->file('hero_background_image');
            $fileName = time() . '_' . $heroBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/contact-us';

            $heroBackgroundImagePath = $heroBackgroundImage->storeAs($folder, $fileName);
        }

        if ($request->hasFile('banner_one_images')) {
            $bannerOneImages = $request->file('banner_one_images');

            foreach ($bannerOneImages as $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $folder = 'public/pages/contact-us';

                $bannerOneImagesPath[] = $folder . '/' . $fileName;
            }
        }

        if ($request->hasFile('seo_image')) {
            $seoImage = $request->file('seo_image');
            $fileName = time() . '_' . $seoImage->getClientOriginalName();
            $folder = 'public/pages/contact-us';

            $seoImagePath = $seoImage->storeAs($folder, $fileName);
        }

        $content->update([
            'page_title' => $validated['page_title'],
            'slug' => Str::slug($validated['page_title']),
            'hero_title' => $validated['hero_title'],
            'hero_sub_title' => $validated['hero_sub_title'],
            'hero_background_image' => $heroBackgroundImagePath,
            'banner_one_title' => $validated['banner_one_title'],
            'banner_one_content' => $validated['banner_one_content'],
            'banner_one_images' => count($bannerOneImagesPath) > 0 ? json_encode($bannerOneImagesPath) : null,
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'seo_image' => $seoImagePath,
            'seo_keywords' => $validated['seo_keywords'],
        ]);

        return redirect()->back()->with('success', 'Contact page created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
