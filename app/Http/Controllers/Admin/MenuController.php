<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::all();
        return view('admin.pages.menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = MenuCategory::all();
        return view('admin.pages.menu.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = null;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/uploads/menu-items');
        }

        Menu::create([
           'name' => $request->name,
           'description' => $request->description,
           'image' => $image,
           'price' => $request->price,
           'category' => $request->category
        ]);
        return redirect('admin/menu')->with('success', 'New Menu Item added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.pages.menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::findOrFail($id);
        $category = MenuCategory::all();
        return view('admin.pages.menu.edit', compact('menu', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuStoreRequest $request, string $id)
    {
        $menu = Menu::findOrFail($id);

        $oldImagePath = $menu->image;
        $image = null;

        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/uploads/menu-items');
        }

        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->category = $request->category;
        $menu->image = $image;

        if($menu->save()){
            if($oldImagePath) {
                Storage::delete($oldImagePath);
            }
        }
        return redirect('admin/menu')->with('success', 'Menu item has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        $imagePath = $menu->image;

        if($menu->delete()){
            if($imagePath){
                Storage::delete($imagePath);
            }
            return redirect('admin/menu')->with('success', 'Menu item has been deleted successfully');
        }
        else {
            return redirect('admin/menu')->with('error', 'Failed to delete Menu Item');
        }
    }
}
