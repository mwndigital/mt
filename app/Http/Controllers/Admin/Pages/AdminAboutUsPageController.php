<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutPageContentStoreRequest;
use App\Models\AboutPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminAboutUsPageController extends Controller
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
        return view('admin.pages.about-page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutPageContentStoreRequest $request)
    {
        $heroBannerBackgroundImage = NULL;
        $aboutBannerImage = NULL;
        $bannerOneImage = NULL;
        $bannerTwoImage = NULL;

        if($request->hasFile('hero_banner_background_image')){
            $heroBannerBackgroundImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'. $heroBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/aboutpage';

            $heroBannerBackgroundImagePath = $heroBannerBackgroundImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('about_banner_image')) {
            $aboutBannerImage = $request->file('about_banner_image');
            $fileName = time().'_'.$aboutBannerImage->getClientOriginalName();
            $folder = 'public/pages/aboutpage';

            $aboutBannerImagePath = $aboutBannerImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_one_image')) {
            $bannerOneImage = $request->file('banner_one_image');
            $fileName = time().'_'.$bannerOneImage->getClientOriginalName();
            $folder = 'public/pages/aboutpage';

            $bannerOneImagePath = $bannerOneImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_two_image')){
            $bannerTwoImage = $request->file('banner_two_image');
            $fileName = time().'_'.$bannerTwoImage->getClientOriginalName();
            $folder = 'public/pages/aboutpage';

            $bannerTwoImagePath = $bannerTwoImage->storeAs($folder, $fileName);
        }

        AboutPageContent::create([
            'page_title' => $request->page_title,
            'page_slug' => Str::slug($request->page_title),
            'hero_banner_background_image' => $heroBannerBackgroundImagePath,
            'hero_banner_title' => $request->hero_banner_title,
            'about_banner_title' => $request->about_banner_title,
            'about_banner_content' => $request->about_banner_content,
            'about_banner_image' => $aboutBannerImagePath,
            'banner_one_image' => $bannerOneImagePath,
            'banner_one_content' => $request->banner_one_content,
            'banner_two_title' => $request->banner_two_title,
            'banner_two_content' => $request->banner_two_content,
            'banner_two_image' => $bannerTwoImagePath,
        ]);

        return redirect()->back()->with('success', 'About page content added successfully');
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
        $apc = AboutPageContent::findOrFail($id);
        return view('admin.pages.about-page.edit', compact('apc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutPageContentStoreRequest $request, string $id)
    {
        $apc = AboutPageContent::findOrFail($id);

        $oldHeroBannerBackgroundImage = $apc->hero_banner_background_image;
        $oldAboutBannerImage = $apc->about_banner_image;
        $oldBannerOneImage = $apc->banner_one_image;
        $oldBannerTwoImage = $apc->banner_two_image;

        if($request->hasFile('hero_banner_background_image')) {
            $heroBannerBackgroundImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'.$heroBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/aboutpage';

            $heroBannerBackgroundImagePath = $heroBannerBackgroundImage->storeAs($folder, $fileName);

            if($oldHeroBannerBackgroundImage){
                Storage::delete($oldHeroBannerBackgroundImage);
            }
        }
        if($request->hasFile('about_banner_image')){
            $aboutBannerImage = $request->file('about_banner_image');
            $fileName = time().'_'.$aboutBannerImage->getClientOriginalName();
            $folder = 'public/pages/aboutpage';

            $aboutBannerImagePath = $aboutBannerImage->storeAs($folder, $fileName);

            if($oldAboutBannerImage) {
                Storage::delete($oldAboutBannerImage);
            }
        }
        if($request->hasFile('banner_one_image')){
            $bannerOneImage = $request->file('banner_one_image');
            $fileName = time().'_'.$bannerOneImage->getClientOriginalName();
            $folder = 'public/pages/aboutpage';

            $bannerOneImagePath = $bannerOneImage->storeAs($folder, $fileName);

            if($oldBannerOneImage) {
                Storage::delete($oldBannerOneImage);
            }
        }
        if($request->hasFile('banner_two_image')){
            $bannerTwoImage = $request->file('banner_two_image');
            $fileName = time().'_'.$bannerTwoImage->getClientOriginalName();
            $folder = 'public/pages/aboutpage';

            $bannerTwoImagePath = $bannerTwoImage->storeAs($folder, $fileName);

            if($oldBannerTwoImage) {
                Storage::delete($oldBannerTwoImage);
            }
        }
        $apc->page_title = $request->page_title;
        $apc->page_slug = $apc->page_slug;
        $apc->hero_banner_background_image = $heroBannerBackgroundImagePath;
        $apc->hero_banner_title = $request->hero_banner_title;
        $apc->about_banner_title = $request->about_banner_title;
        $apc->about_banner_content = $request->about_banner_content;
        $apc->about_banner_image = $aboutBannerImagePath;
        $apc->banner_one_image = $bannerOneImagePath;
        $apc->banner_one_content = $request->banner_one_content;
        $apc->banner_two_title = $request->banner_two_title;
        $apc->banner_two_content = $request->banner_two_content;
        $apc->banner_two_image = $bannerTwoImagePath;
        $apc->save();

        return redirect()->back()->with('success', 'About Page has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
