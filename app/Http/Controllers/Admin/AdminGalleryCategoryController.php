<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryCategoryStoreRequest;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = GalleryCategory::all();

        return view('admin.pages.gallery.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.gallery.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryCategoryStoreRequest $request)
    {
        $featuredImage = NULL;

        if($request->hasFile('featured_image')){
            $featuredImage = $request->file('featured_image');
            $fileName = time().'_'.$featuredImage->getClientOriginalName();
            $folder = 'public/gallery/categories';

            $featuredImagePath = $featuredImage->storeAs($folder, $fileName);
        }

        GalleryCategory::create([
            'name' => $request->name,
            'featured_image' => $featuredImagePath,
        ]);

        return redirect('admin/gallery/gallery-category')->with('success', 'Gallery Category created successfully');
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
        $category = GalleryCategory::findOrFail($id);

        return view('admin.pages.gallery.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = GalleryCategory::findOrFail($id);

        $currentImage = $category->featured_image;

        $newImage = NULL;

        if($request->hasFile('featured_image')) {
            $newImage = $request->file('featured_image');
            $fileName = time().'_'.$newImage->getClientOriginalName();
            $folder = 'public/gallery/categories';

            $newImagePath = $newImage->storeAs($folder, $fileName);

            if($currentImage) {
                Storage::delete($currentImage);
            }

            $category->name = $request->input('name');
            $category->featured_image = $newImagePath;
            $category->save();

            return redirect('admin/gallery/gallery-category')->with('success', 'Gallery Category has been updated successfully');
        }
        else {
            $category->name = $request->input('name');
            $category->featured_image = $category->featured_image;
            $category->save();

            return redirect('admin/gallery/gallery-category')->with('success', 'Gallery category has been updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = GalleryCategory::findOrFail($id);

        $category->delete();
        if($category->featured_image) {
            Storage::delete($category->featured_image);
        }

        return redirect('admin/gallery/gallery-category')->with('success', 'Category deleted successfully');
    }
}
