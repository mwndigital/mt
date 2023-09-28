<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomsContentStoreRequest;
use App\Http\Requests\RoomsContentUpdateStoreRequest;
use App\Models\RoomsPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminRoomsPageController extends Controller
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
        return view('admin.pages.rooms-page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomsContentStoreRequest $request)
    {
        $heroBannerBackgroundImage = NULL;
        $pageImage = NULL;
        $heroBannerBackgroundImagePath = NULL;
        $pageImagePath = NULL;

        if($request->hasFile('hero_banner_background_image')){
            $heroBannerBackgroundImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'.$heroBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/roomspage';

            $heroBannerBackgroundImagePath = $heroBannerBackgroundImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('page_image')) {
            $pageImage = $request->file('page_image');
            $fileName = time().'_'.$pageImage->getClientOriginalName();
            $folder = 'public/pages/roomspage';

            $pageImagePath = $pageImage->storeAs($folder, $fileName);
        }

        RoomsPageContent::create([
            'page_title' => $request->page_title,
            'page_slug' => Str::slug($request->page_title),
            'hero_banner_title' => $request->hero_banner_title,
            'hero_banner_background_image' => $heroBannerBackgroundImagePath,
            'rooms_info_banner_content' => $request->rooms_info_banner_content,
            'page_description' => $request->page_description,
            'page_keywords' => $request->page_keywords,
            'page_type' => 'website',
            'page_image' => $pageImagePath
        ]);
        return redirect()->back()->with('success', 'Rooms page content added successfully');
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
    public function edit($id)
    {
        $content = RoomsPageContent::findOrFail($id);
        return view('admin.pages.rooms-page.edit', compact('content'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $content = RoomsPageContent::findOrFail($id);

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'hero_banner_title' => ['required', 'string', 'max:255'],
            'hero_content' => ['required', 'max:15000'],
            'hero_banner_background_image' => [
                // Apply 'required' rule only if a file has been uploaded
                $request->hasFile('hero_banner_background_image') ? 'required' : '',
                'image',
                'mimes:jpg,jpeg,png,svg,webp',
            ],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp'],
            'seo_keywords' => ['nullable', 'string', 'max:300'],
        ]);

        $oldHeroBannerBackgroundImage = $content->hero_banner_background_image;
        $heroBannerBackgroundImagePath = NULL;
        $oldSeoImage = $content->seo_image;
        $seoImagePath = NULL;

        if($request->hasFile('hero_banner_background_image')) {
            $heroBannerBackgroundImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'.$heroBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/roomspage';

            $heroBannerBackgroundImagePath = $heroBannerBackgroundImage->storeAs($folder, $fileName);

            if($oldHeroBannerBackgroundImage){
                Storage::delete($oldHeroBannerBackgroundImage);
            }
        }
        if($request->hasFile('seo_image')){
            $seoImage = $request->file('seo_image');
            $fileName = time().'_'.$seoImage->getClientOriginalName();
            $folder = 'public/pages/roomspage';
            $seoImagePath = $seoImage->storeAs($folder, $fileName);

            if($oldSeoImage) {
                Storage::delete($oldSeoImage);
            }
        }

        //dd($validated);

        $content->update([
            "page_title" => $validated['page_title'],
            "slug" => $content->slug,
            "hero_banner_title" => $validated['hero_banner_title'],
            "hero_content" => $validated['hero_content'],
            "hero_banner_background_image" => $heroBannerBackgroundImagePath,
            "seo_title" => $validated['seo_title'],
            "seo_description" => $validated['seo_description'],
            "seo_image" => $seoImagePath,
            "seo_keywords" => $validated['seo_keywords'],
        ]);

        return redirect()->back()->with('success', 'Rooms page content updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
