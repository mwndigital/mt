<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuCategoryStoreRequest;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = MenuCategory::all();
        return view('admin.pages.menu.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.menu.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuCategoryStoreRequest $request)
    {
        $image = null;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/uploads/menu-categories');
        }


        MenuCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);
        return redirect('admin/menu/category')->with('success', 'New menu category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = MenuCategory::findOrFail($id);
        return view('admin.pages.menu.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = MenuCategory::findOrFail($id);

        return view('admin.pages.menu.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuCategoryStoreRequest $request, string $id)
    {
        $category = MenuCategory::findOrFail($id);

        $oldImagePath = $category->image;

        $image = null;

        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/uploads/menu-categories');
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $image;

        if($category->save()){
            if($oldImagePath){
                Storage::delete($oldImagePath);
            }
        }
        return redirect('admin/menu/category')->with('success', 'Menu Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = MenuCategory::findOrFail($id);
        $imagePath = $category->image;

        if($category->delete()){
            if($imagePath){
                Storage::delete($imagePath);
            }
            return redirect('admin/menu/category')->with('success', 'Menu Category deleted successfully');
        }
        else {
            return redirect('admin/menu/category')->with('error', 'Failed to delete Menu Category');
        }
    }
}
