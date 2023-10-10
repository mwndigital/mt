<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\LodgePageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminLodgePageController extends Controller
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
        return view('admin.pages.lodge.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $heroBackgroundImage = NULL;
        $heroBackgroundImagePath = NULL;
        $bannerOneImages = NULL;

        $bannerTwoImage = NULL;
        $bannerTwoImagePath = NULL;
        $bannerThreeImage = NULL;
        $bannerThreeImagePath = NULL;
        $seoImage = NULL;
        $seoImagePath = NULL;



        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_content' => ['required'],
            'hero_background_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_title' => ['required', 'string', 'max:255'],
            'banner_one_content' => ['required'],
            'banner_two_title' => ['required', 'string', 'max:255'],
            'banner_two_content' => ['required'],
            'banner_two_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_three_title' => ['required', 'string', 'max:255'],
            'banner_three_content' => ['required'],
            'banner_three_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
        ]);

        if($request->hasFile('hero_background_image')) {
            $heroBackgroundImage = $request->file('hero_background_image');
            $fileName = time().'_'.$heroBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/lodge';

            $heroBackgroundImagePath = $heroBackgroundImage->storeAs($folder, $fileName);
        }
        if ($request->hasFile('banner_one_images')) {
            foreach ($request->file('banner_one_images') as $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $folder = 'public/pages/lodge';
                $imagePath = $image->storeAs($folder, $fileName);
                $images[] = $imagePath;
            }
        }
        if($request->hasFile('banner_two_image')) {
            $bannerTwoImage = $request->file('banner_one_image');
            $fileName = time().'_'.$bannerTwoImage->getClientOriginalName();
            $folder = 'public/pages/lodge';

            $bannerTwoImagePath = $bannerTwoImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_three_image')){
            $bannerThreeImage = $request->file('banner_three_image');
            $fileName = time().'_'.$bannerThreeImage->getClientOriginalName();
            $folder = 'public/pages/lodge';

            $bannerThreeImagePath = $bannerThreeImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('seo_image')){
            $seoImage = $request->file('seo_image');
            $fileName = time().'_'.$seoImage->getClientOriginalName();
            $folder = 'public/pages/lodge';

            $seoImagePath = $seoImage->storeAs($folder, $fileName);
        }

        LodgePageContent::create([
            'page_title' => $validated['page_title'],
            'slug' => Str::slug($validated['page_title']),
            'hero_title' => $validated['hero_title'],
            'hero_content' => $validated['hero_content'],
            'hero_background_image' => $heroBackgroundImagePath,
            'banner_one_title' => $validated['banner_one_title'],
            'banner_one_content' => $validated['banner_one_content'],
            'banner_one_images' => $images,
            'banner_two_title' => $validated['banner_two_title'],
            'banner_two_content' => $validated['banner_two_content'],
            'banner_two_image' => $bannerTwoImagePath,
            'banner_three_title' => $validated['banner_three_title'],            'banner_three_content' => $validated['banner_three_content'],
            'banner_three_image' => $bannerThreeImagePath,
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'seo_keywords' => $validated['seo_keywords'],
            'seo_image' => $seoImagePath
        ]);

        return redirect()->back()->with('success', 'Lodge page content added successfully');

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
        $content = LodgePageContent::findOrFail($id);

        return view('admin.pages.lodge.edit', compact('content'));
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
