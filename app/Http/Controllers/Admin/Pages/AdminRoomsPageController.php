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
        $rpc = RoomsPageContent::findOrFail($id);
        return view('admin.pages.rooms-page.edit', compact('rpc'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RoomsContentUpdateStoreRequest $request, string $id)
    {
        $rpc = RoomsPageContent::findOrFail($id);

        $oldHeroBannerBackgroundImage = $rpc->head_banner_background_image;
        $oldPageImage = $rpc->page_image;
        $heroBannerBackgroundImagePath = NULL;
        $pageImagePath = NULL;

        if($request->hasFile('hero_banner_background_image')) {
            $heroBannerBackgroundImage = $request->file('hero_banner_background_image');
            $fileName = time().'_'.$heroBannerBackgroundImage->getClientOriginalName();
            $folder = 'public/pages/roomspage';

            $heroBannerBackgroundImagePath = $heroBannerBackgroundImage->storeAs($folder, $fileName);

            if($oldHeroBannerBackgroundImage) {
                Storage::delete($oldHeroBannerBackgroundImage);
            }
        }
        if($request->hasFile('page_image')) {
            $pageImage = $request->file('page_image');
            $fileName = time().'_'.$pageImage->getClientOriginalName();
            $folder = 'public/pages/roomspage';

            $pageImagePath = $pageImage->storeAs($folder, $fileName);

            if($oldPageImage) {
                Storage::delete($oldPageImage);
            }
        }
        $rpc->page_title = $request->page_title;
        $rpc->page_slug = $rpc->page_slug;
        $rpc->hero_banner_title = $request->hero_banner_title;
        $rpc->hero_banner_background_image = $heroBannerBackgroundImagePath;
        $rpc->rooms_info_banner_content = $request->rooms_info_banner_content;
        $rpc->page_description = $request->page_description;
        $rpc->page_keywords = $request->page_keywords;
        $rpc->page_image = $pageImagePath;
        $rpc->save();

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
