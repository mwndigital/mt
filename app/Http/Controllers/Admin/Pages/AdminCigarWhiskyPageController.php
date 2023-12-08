<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\CigarWhiskyPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCigarWhiskyPageController extends Controller
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
        return view('admin.pages.cigar-whisky.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hero_bg_image = NULL;
        $hero_bg_image_path = NULL;
        $banner_one_image = NULL;
        $banner_one_image_path = NULL;
        $banner_two_image = NULL;
        $banner_two_image_path = NULL;
        $banner_three_image = NULL;
        $banner_three_image_path = NULL;
        $seo_image = NULL;
        $seo_image_path = NULL;

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_content' => ['required', 'max:15000'],
            'hero_bg_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_title' => ['required', 'string', 'max:255'],
            'banner_one_content' => ['required', 'max:50000'],
            'banner_one_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_two_title' => ['required', 'string', 'max:255'],
            'banner_two_content' => ['required', 'max:50000'],
            'banner_two_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_three_title' => ['required', 'string', 'max:255'],
            'banner_three_content' => ['required', 'max:50000'],
            'banner_three_image' => ['required', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
        ]);

        if($request->hasFile('hero_bg_image')){
            $hero_bg_image = $request->file('hero_bg_image');
            $fileName = time().'_'.$hero_bg_image->getClientOriginalName();
            $folder = 'public/pages/cigar_whisky_shop_page';

            $hero_bg_image_path = $hero_bg_image->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_one_image')){
            $banner_one_image = $request->file('banner_one_image');
            $fileName = time().'_'. $banner_one_image->getClientOriginalName();
            $folder = 'public/pages/cigar_whisky_shop_page';
            $banner_one_image_path = $banner_one_image->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_two_image')){
            $banner_two_image = $request->file('banner_two_image');
            $fileName = time().'_'. $banner_two_image->getClientOriginalName();
            $folder = 'public/pages/cigar_whisky_shop_page';
            $banner_two_image_path = $banner_two_image->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_three_image')){
            $banner_three_image = $request->file('banner_three_image');
            $fileName = time().'_'. $banner_three_image->getClientOriginalName();
            $folder = 'public/pages/cigar_whisky_shop_page';
            $banner_three_image_path = $banner_three_image->storeAs($folder, $fileName);
        }
        if($request->hasFile('seo_image')){
            $seo_image = $request->file('seo_image');
            $fileName = time().'_'. $seo_image->getClientOriginalName();
            $folder = 'public/pages/cigar_whisky_shop_page';
            $seo_image_path = $seo_image->storeAs($folder, $fileName);
        }

        CigarWhiskyPageContent::create([
            'page_title' => $validated['page_title'],
            'slug' => Str::slug($validated['page_title']),
            'hero_title' => $validated['hero_title'],
            'hero_content' => $validated['hero_content'],
            'hero_bg_image' => $hero_bg_image_path,
            'banner_one_title' => $validated['banner_one_title'],
            'banner_one_content' => $validated['banner_one_content'],
            'banner_one_image' => $banner_one_image_path,
            'banner_two_title' => $validated['banner_two_title'],
            'banner_two_content' => $validated['banner_two_content'],
            'banner_two_image' => $banner_two_image_path,
            'banner_three_title' => $validated['banner_three_title'],
            'banner_three_content' => $validated['banner_three_content'],
            'banner_three_image' => $banner_three_image_path,
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'seo_image' => $seo_image_path,
        ]);

        return redirect()->back()->with('success', 'Page content created');
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
        $content = CigarWhiskyPageContent::findOrFail($id);

        return view('admin.pages.cigar-whisky.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $content = CigarWhiskyPageContent::findOrFail($id);

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_content' => ['required', 'max:15000'],
            'hero_bg_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_one_title' => ['required', 'string', 'max:255'],
            'banner_one_content' => ['required', 'max:50000'],
            'banner_one_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_two_title' => ['required', 'string', 'max:255'],
            'banner_two_content' => ['required', 'max:50000'],
            'banner_two_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'banner_three_title' => ['required', 'string', 'max:255'],
            'banner_three_content' => ['required', 'max:50000'],
            'banner_three_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
        ]);

        if($request->hasFile('hero_bg_image')){
            $hero_bg_image = $request->file('hero_bg_image');
            $fileName = time().'_'.$hero_bg_image->getClientOriginalName();
            $folder = 'public/pages/cigar_whisky_shop_page';

            $hero_bg_image_path = $hero_bg_image->storeAs($folder, $fileName);
        }
        else {
            $hero_bg_image_path = $content->hero_bg_image;
        }
        if($request->hasFile('banner_one_image')){
            $banner_one_image = $request->file('banner_one_image');
            $fileName = time().'_'. $banner_one_image->getClientOriginalName();
            $folder = 'public/pages/cigar_whisky_shop_page';
            $banner_one_image_path = $banner_one_image->storeAs($folder, $fileName);
        }
        else {
            $banner_one_image_path = $content->banner_one_image;
        }
        if($request->hasFile('banner_two_image')){
            $banner_two_image = $request->file('banner_two_image');
            $fileName = time().'_'. $banner_two_image->getClientOriginalName();
            $folder = 'public/pages/cigar_whisky_shop_page';
            $banner_two_image_path = $banner_two_image->storeAs($folder, $fileName);
        }
        else {
            $banner_two_image_path = $content->banner_two_image;
        }
        if($request->hasFile('banner_three_image')){
            $banner_three_image = $request->file('banner_three_image');
            $fileName = time().'_'. $banner_three_image->getClientOriginalName();
            $folder = 'public/pages/cigar_whisky_shop_page';
            $banner_three_image_path = $banner_three_image->storeAs($folder, $fileName);
        }
        else {
            $banner_three_image_path = $content->banner_three_image;
        }
        if($request->hasFile('seo_image')){
            $seo_image = $request->file('seo_image');
            $fileName = time().'_'. $seo_image->getClientOriginalName();
            $folder = 'public/pages/cigar_whisky_shop_page';
            $seo_image_path = $seo_image->storeAs($folder, $fileName);
        }
        else {
            $seo_image_path = $content->seo_image;
        }

        $content->update([
            'page_title' => $validated['page_title'],
            'slug' => Str::slug($validated['page_title']),
            'hero_title' => $validated['hero_title'],
            'hero_content' => $validated['hero_content'],
            'hero_bg_image' => $hero_bg_image_path,
            'banner_one_title' => $validated['banner_one_title'],
            'banner_one_content' => $validated['banner_one_content'],
            'banner_one_image' => $banner_one_image_path,
            'banner_two_title' => $validated['banner_two_title'],
            'banner_two_content' => $validated['banner_two_content'],
            'banner_two_image' => $banner_two_image_path,
            'banner_three_title' => $validated['banner_three_title'],
            'banner_three_content' => $validated['banner_three_content'],
            'banner_three_image' => $banner_three_image_path,
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'seo_image' => $seo_image_path,
        ]);

        return redirect()->back()->with('success', 'Page content updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
