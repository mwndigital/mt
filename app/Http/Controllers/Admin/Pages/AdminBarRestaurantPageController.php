<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarRestaurantContentStoreRequest;
use App\Http\Requests\BarRestaurantContentUpdateStoreRequest;
use App\Models\BarRestaurantContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBarRestaurantPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.bar-restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarRestaurantContentStoreRequest $request)
    {
        $heroBannerBackgroundImage = NULL;
        $bannerOneBigImage = NULL;
        $bannerOneSmallImage = NULL;
        $bannerTwoImage = NULL;
        $separatorBackgroundImage = NULL;
        $bookStayBannerBackgroundImage = NULL;

        if($request->hasFile('hero_banner_background_image')) {
            $heroBannerBackgroundImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'.$heroBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/bar_restaurant';

            $heroBannerImagePath = $heroBannerBackgroundImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_one_big_image')) {
            $bannerOneBigImage = $request->file('banner_one_big_image');
            $fileName = time().'_'.$bannerOneBigImage->getClientOriginalName();
            $folder = 'public/pages/bar_restaurant';

            $bannerOneBigImagePath = $bannerOneBigImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_one_small_image')) {
            $bannerOneSmallImage = $request->file('banner_one_small_image');
            $fileName = time().'_'.$bannerOneSmallImage->getClientOriginalName();
            $folder = 'public/pages/bar_restaurant';

            $bannerOneSmallImagePath = $bannerOneSmallImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('separator_banner_image')){
            $separatorBackgroundImage = $request->file('separator_banner_image');
            $fileName = time().'_'.$separatorBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/bar_restaurant';

            $separatorBackgroundImagePath = $separatorBackgroundImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('banner_two_image')) {
            $bannerTwoImage = $request->file('banner_two_image');
            $fileName = time().'_'.$bannerTwoImage->getClientOriginalName();
            $folder = 'public/pages/bar_restaurant';

            $bannerTwoImagePath = $bannerTwoImage->storeAs($folder, $fileName);
        }
        if($request->hasFile('book_stay_banner_background_image')){
            $bookStayBannerBackgroundImage = $request->file('book_stay_banner_background_image');
            $fileName = time().'_'.$bookStayBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/bar_restaurant';

            $bookStayBannerBackgroundImagePath = $bookStayBannerBackgroundImage->storeAs($folder, $fileName);
        }

        BarRestaurantContent::create([
            'hero_banner_title' => $request->hero_banner_title,
            'hero_banner_background_image' => $heroBannerImagePath,
            'banner_one_title' => $request->banner_one_title,
            'banner_one_content' => $request->banner_one_content,
            'banner_one_big_image' => $bannerOneBigImagePath,
            'banner_one_small_image' => $bannerOneSmallImagePath,
            'separator_banner_image' => $separatorBackgroundImagePath,
            'banner_two_title' => $request->banner_two_title,
            'banner_two_content' => $request->banner_two_content,
            'banner_two_image' => $bannerTwoImagePath,
            'book_stay_banner_title' => $request->book_stay_banner_title,
            'book_stay_banner_content' => $request->book_stay_banner_content,
            'book_stay_banner_background_image' => $bookStayBannerBackgroundImagePath
        ]);

        return redirect()->back()->with('success', 'Bar Restaurant page content added successfully');

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
        $brc = BarRestaurantContent::findOrFail($id);
        return view('admin.pages.bar-restaurant.edit', compact('brc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BarRestaurantContentUpdateStoreRequest $request, string $id)
    {
        $brc = BarRestaurantContent::findOrFail($id);

        $oldHeroBannerBackgroundImage = $brc->hero_banner_background_image;
        $oldBannerOneBigImage = $brc->banner_one_big_image;
        $oldBannerOneSmallImage = $brc->banner_one_small_image;
        $oldSeparatorImage = $brc->separator_banner_image;
        $oldBannerTwoImage = $brc->banner_two_image;
        $oldBookStayBannerBackgroundImage = $brc->book_stay_banner_background_image;
        $oldPageImage = $brc->page_image;
        $heroBannerBackgroundImagePath = NULL;
        $bannerOneBigImagePath = NULL;
        $bannerOneSmallImagePath = NULL;
        $separatorImagePath = NULL;
        $bannerTwoImagePath = NULL;
        $bookStayBannerBackgroundImagePath = NULL;
        $pageImagePath = NULL;


        if($request->hasFile('hero_banner_background_image')){
            $heroBannerBackgroundImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'.$heroBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/bar_restaurant';

            $heroBannerBackgroundImagePath = $heroBannerBackgroundImage->storeAs($folder, $fileName);

            if($oldHeroBannerBackgroundImage) {
                Storage::delete($oldHeroBannerBackgroundImage);
            }
        }
        if($request->hasFile('banner_one_big_image')) {
            $bannerOneBigImage = $request->file('banner_one_big_image');
            $fileName = time().'_'.$bannerOneBigImage->getClientOriginalName();
            $folder = 'public/pages/bar_restaurant';

            $bannerOneBigImagePath = $bannerOneBigImage->storeAs($folder, $fileName);

            if($oldBannerOneBigImage) {
                Storage::delete($oldBannerOneBigImage);
            }
        }
        if($request->hasFile('banner_one_small_image')) {
            $bannerOneSmallImage = $request->file('banner_one_small_image');
            $fileName = time().'_'.$bannerOneSmallImage->getClientOriginalName();
            $folder = 'public/pages/bar_restaurant';

            $bannerOneSmallImagePath = $bannerOneSmallImage->storeAs($folder, $fileName);

            if($oldBannerOneSmallImage){
                Storage::delete($oldBannerOneSmallImage);
            }
        }
        if($request->hasFile('separator_banner_image')) {
            $separatorImage = $request->file('separator_banner_image');
            $fileName = time().'_'.$separatorImage->getClientOriginalName();
            $folder = 'public/pages/bar_restaurant';

            $separatorImagePath = $separatorImage->storeAs($folder, $fileName);

            if($oldSeparatorImage) {
                Storage::delete($oldSeparatorImage);
            }
        }
        if($request->hasFile('banner_two_image')) {
            $bannerTwoImage = $request->file('banner_two_image');
            $fileName = time().'_'.$bannerTwoImage->getClientOriginalName();
            $folder = 'public/pages/bar_restaurant';

            $bannerTwoImagePath = $bannerTwoImage->storeAs($folder, $fileName);

            if($oldBannerTwoImage) {
                Storage::delete($oldBannerTwoImage);
            }
        }
        if($request->hasFile('book_stay_banner_background_image')){
            $bookStayBannerBackgroundImage = $request->file('book_stay_banner_background_image');
            $fileName = time().'_'.$bookStayBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/restaurant_bar';

            $bookStayBannerBackgroundImagePath = $bookStayBannerBackgroundImage->storeAs($folder, $fileName);

            if($oldBookStayBannerBackgroundImage) {
                Storage::delete($oldBookStayBannerBackgroundImage);
            }
        }
        if($request->hasFile('page_image')) {
            $pageImage = $request->file('page_image');
            $fileName = time().'_'.$pageImage->getClientOriginalName();
            $folder = 'public/pages/restaurant_bar';

            $pageImagePath = $pageImage->storeAs($folder, $fileName);

            if($oldPageImage) {
                Storage::delete($oldPageImage);
            }
        }

        $brc->page_title = $request->page_title;
        $brc->page_slug = $brc->page_slug;
        $brc->hero_banner_background_image = $heroBannerBackgroundImagePath;
        $brc->banner_one_title = $request->banner_one_title;
        $brc->banner_one_content = $request->banner_one_content;
        $brc->banner_one_big_image = $bannerOneBigImagePath;
        $brc->banner_one_small_image = $bannerOneSmallImagePath;
        $brc->separator_banner_image = $separatorImagePath;
        $brc->banner_two_title = $request->banner_two_title;
        $brc->banner_two_content = $request->banner_two_content;
        $brc->banner_two_image = $bannerTwoImagePath;
        $brc->book_stay_banner_title = $request->book_stay_banner_title;
        $brc->book_stay_banner_content = $request->book_stay_banner_content;
        $brc->book_stay_banner_background_image = $bookStayBannerBackgroundImagePath;
        $brc->page_description = $request->page_description;
        $brc->page_keywords = $request->page_keywords;
        $brc->page_image = $pageImagePath;
        $brc->save();

        return redirect()->back()->with('success', 'Bar Restaurant page updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
