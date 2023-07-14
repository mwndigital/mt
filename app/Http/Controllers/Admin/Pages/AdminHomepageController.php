<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomepageContentStoreRequest;
use App\Models\HomePageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hpcontent = HomePageContent::all();
        return view('admin.pages.homepage.index', compact('hpcontent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.homepage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HomepageContentStoreRequest $request)
    {
        $heroBannerBackgroundImage = NULL;
        $bannerOneImage = NULL;
        $spendNightBannerBackgroundImage = NULL;

        if($request->hasFile('hero_banner_background_image')){
            $heroBannerBackgroundImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'.$heroBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/homepage';

            $heroBannerBackgroundImagePath = $heroBannerBackgroundImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_one_image')){
            $bannerOneImage = $request->file('banner_one_image');
            $fileName = time().'_'.$bannerOneImage->getClientOriginalName();
            $folder = 'public/pages/homepage';

            $bannerOneImagePath = $bannerOneImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('spend_night_banner_background_image')){
            $spendNightBannerBackgroundImage = $request->file('spend_night_banner_background_image');
            $fileName = time().'_'.$spendNightBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/homepage';

            $spendNightBannerBackgroundImagePath = $spendNightBannerBackgroundImage->storeAs($folder, $fileName);
        }
        HomePageContent::create([
           'hero_banner_title' => $request->hero_banner_title,
           'hero_banner_content' => $request->hero_banner_content,
           'hero_banner_background_image' => $heroBannerBackgroundImagePath,
           'banner_one_image' => $bannerOneImagePath,
           'banner_one_title' => $request->banner_one_title,
           'banner_one_content' => $request->banner_one_content,
           'banner_one_button_link' => $request->banner_one_button_link,
           'rooms_banner_sub_title' => $request->rooms_banner_sub_title,
           'rooms_banner_title' => $request->rooms_banner_title,
           'rooms_banner_content' => $request->rooms_banner_content,
           'rooms_banner_button_link' => $request->rooms_banner_button_link,
           'spend_night_banner_title' => $request->spend_night_banner_title,
           'spend_night_banner_content' => $request->spend_night_banner_content,
           'spend_night_banner_button_link' => $request->spend_night_banner_button_link,
           'spend_night_banner_background_image' => $spendNightBannerBackgroundImagePath,
        ]);

        return redirect()->back()->with('success', 'Page content has been saved successfully');
    }

    public function show(){}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hpcontent = HomePageContent::findOrFail($id);


        return view('admin.pages.homepage.edit', compact('hpcontent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hpcontent = HomePageContent::findOrFail($id);
        $oldHeroBannerBackgroundImagePath = $hpcontent->hero_banner_background_image;
        $oldBannerOneImagePath = $hpcontent->banner_one_image;
        $oldSpendNightBannerBackgroundImagePath = $hpcontent->spend_night_banner_background_image;

        if($request->hasFile('hero_banner_background_image')){
            $heroBannerBackgroundImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'.$heroBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/homepage';

            $heroBannerBackgroundImagePath = $heroBannerBackgroundImage->storeAs($folder, $fileName);

            if($oldHeroBannerBackgroundImagePath) {
                Storage::delete($oldHeroBannerBackgroundImagePath);
            }
        }
        if($request->hasFile('banner_one_image')) {
            $bannerOneImage = $request->file('banner_one_image');
            $fileName = time().'_'.$bannerOneImage->getClientOriginalName();
            $folder = 'public/pages/homepage';

            $bannerOneImagePath = $bannerOneImage->storeAs($folder, $fileName);

            if($oldBannerOneImagePath) {
                Storage::delete($oldBannerOneImagePath);
            }
        }
        if($request->hasFile('spend_night_banner_background_image')) {
            $spendNightBannerImage = $request->file('spend_night_banner_background_image');
            $fileName = time().'_'.$spendNightBannerImage->getClientOriginalName();
            $folder = 'public/pages/homepage';

            $spendNightBannerImagePath = $spendNightBannerImage->storeAs($folder, $fileName);

            if($oldSpendNightBannerBackgroundImagePath) {
                Storage::delete($oldSpendNightBannerBackgroundImagePath);
            }
        }
        $hpcontent->hero_banner_title = $request->hero_banner_title;
        $hpcontent->hero_banner_content = $request->hero_banner_content;
        $hpcontent->hero_banner_background_image = $heroBannerBackgroundImagePath;
        $hpcontent->banner_one_image = $bannerOneImagePath;
        $hpcontent->banner_one_title = $request->banner_one_title;
        $hpcontent->banner_one_content = $request->banner_one_content;
        $hpcontent->banner_one_button_link = $request->banner_one_button_link;
        $hpcontent->rooms_banner_sub_title = $request->rooms_banner_sub_titke;
        $hpcontent->rooms_banner_title = $request->rooms_banner_title;
        $hpcontent->rooms_banner_button_link = $request->rooms_banner_button_link;
        $hpcontent->spend_night_banner_title = $request->spend_night_banner_title;
        $hpcontent->spend_night_banner_content = $request->spend_night_banner_content;
        $hpcontent->spend_night_banner_button_link = $request->spend_night_banner_button_link;
        $hpcontent->spend_night_banner_background_image = $spendNightBannerImagePath;
        $hpcontent->save();

        return redirect()->back()->with('success', 'Homepage content has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
