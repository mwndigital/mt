<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\AboutPageContentNew;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminAboutUsPageNewController extends Controller
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
        return view('admin.pages.about-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('hero_bg_image')){
            $heroBgImage = $request->input('hero_bg_image');

            $fileName = time().'_'.$heroBgImage->getClientOriginalName();
            $folder = 'public/about-us/';

            $heroBgImagePath = $heroBgImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_two_image')){
            $bannerOneImage = $request->input('banner_two_image');

            $fileName = time().'_'.$bannerOneImage->getClientOriginalName();
            $folder = 'public/about-us/';

            $bannerOneImagePath = $bannerOneImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_four_image')) {
            $bannerFourImage = $request->input('banner_four_image');

            $fileName = time() . '_' . $bannerFourImage->getClientOriginalName();
            $folder = 'public/about-us/';

            $bannerFourImagePath = $bannerFourImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_five_image')){
            $bannerFiveImage = $request->input('banner_five_image');

            $fileName = time().'_'.$bannerFiveImage->getClientOriginalName();
            $folder = 'public/about-us/';

            $bannerFiveImagePath = $bannerFiveImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_six_image')){
            $bannerSixImage = $request->input('banner_six_image');

            $fileName = time().'_'.$bannerSixImage->getClientOriginalName();
            $folder = 'public/about-us/';

            $bannerSixImagePath = $bannerSixImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_eight_image')){
            $bannerEightImage = $request->input('banner_eight_image');

            $fileName = time().'_'.$bannerEightImage->getClientOriginalName();
            $folder = 'public/about-us/';

            $bannerEightImagePath = $bannerEightImage->storeAs($folder, $fileName);
        }


        AboutPageContentNew::create([
            'page_title' => $request->input('page_title'),
            'page_slug' => Str::slug($request->input('page_title')),
            'hero_title' => $request->input('hero_title'),
            'hero_content' => $request->input('hero_content'),
            'her_bg_image' => $heroBgImagePath,
            'banner_one_title' => $request->input('banner_one_title'),
            'banner_one_content' => $request->input('banner_one_content'),
            'banner_one_image' => $bannerOneImagePath,

            'banner_two_title' => $request->input('banner_two_title'),
            'banner_two_content' => $request->input('banner_two_content'),

            'banner_three_title' => $request->input('banner_three_title'),
            'banner_three_content' => $request->input('banner_three_content'),
            'banner_four_title' => $request->input('banner_four_title'),
            'banner_four_content' => $request->input('banner_four_content'),
            'banner_four_image' => $bannerFourImagePath,

            'banner_five_title' => $request->input('banner_five_title'),
            'banner_five_content' => $request->input('banner_five_content'),
            'banner_five_image' => $bannerFiveImagePath,

            'banner_six_title' => $request->input('banner_six_title'),
            'banner_six_content' => $request->input('banner_six_content'),
            'banner_six_image' => $bannerSixImagePath,

            'banner_seven_title' => $request->input('banner_seven_title'),
            'banner_seven_content' => $request->input('banner_seven_content'),
            'banner_eight_title' => $request->input('banner_eight_title'),
            'banner_eight_content' => $request->input('banner_eight_content'),
            'banner_eight_image' => $bannerEightImagePath,
        ]);

        return redirect()->back()->with('success', 'About page content created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $content = AboutPageContentNew::findOrFail($id);

        return view('admin.pages.about-us.edit', compact('content'));
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
