<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryItemStoreRequest;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;

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
