<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryItemStoreRequest;
use App\Http\Requests\GalleryItemUpdateRequest;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleryItem = Gallery::all();
        return view('admin.pages.gallery.index', compact('galleryItem'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = GalleryCategory::all();
        return view('admin.pages.gallery.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryItemStoreRequest $request)
    {
        $mainImage = NULL;

        if($request->hasFile('image')){
            $mainImage = $request->file('image');
            $fileName = time().'_'.$mainImage->getClientOriginalName();
            $folder = 'public/gallery';

            $imagePath = $mainImage->storeAs($folder, $fileName);
        }

        Gallery::create([
            'name' => $request->name,
            'image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect('admin/gallery')->with('success', 'New category item has been created');
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
        $item = Gallery::findOrFail($id);
        $category = GalleryCategory::all();
        return view('admin.pages.gallery.edit', compact('item', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryItemUpdateRequest $request, string $id)
    {
        $item = Gallery::findOrFail($id);

        $currentImage = $item->image;

        $newImage = NULL;

        if($request->hasFile('image')){
            $newImage = $request->file('image');
            $fileName = time().'_'.$newImage->getClientOriginalName();
            $folder = 'public/gallery';

            $newImagePath = $newImage->storeAs($folder, $fileName);

            if($currentImage){
                Storage::delete($currentImage);
            }

            $item->name = $request->name;
            $item->image = $newImagePath;
            $item->category_id = $request->category_id;
            $item->save();

            return redirect('admin/gallery')->with('success', 'Gallery item has been updated successfully');
        }
        else {

            $item->name = $request->name;
            $item->image = $currentImage;
            $item->category_id = $request->category_id;
            $item->save();

            return redirect('admin/gallery')->with('success', 'Gallery item has been updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Gallery::findOrFail($id);
        $item->delete();
        if($item->image) {
            Storage::delete($item->image);
        }
        return redirect('admin/gallery')->with('success', 'Gallery item deleted successfully');
    }
}
