<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WhiskyStoreRequest;
use App\Models\Whisky;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhiskyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whisky = Whisky::all();
        return view('admin.pages.whisky.index', compact('whisky'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.whisky.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WhiskyStoreRequest $request)
    {
        $image = null;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/uploads/whisky-selection');
        }

        Whisky::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
            'drink_size' => $request->drink_size,
        ]);

        return redirect('admin/whisky')->with('success', 'New whisky has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $whisky = Whisky::findOrFail($id);

        return view('admin.pages.whisky.show', compact('whisky'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $whisky = Whisky::findOrFail($id);

        return view('admin.pages.whisky.edit', compact('whisky'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WhiskyStoreRequest $request, string $id)
    {
        $whisky = Whisky::findOrFail($id);

        $oldImagePath = $whisky->image;

        $image = null;

        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/uploads/whisky-selection');
        }

        $whisky->name = $request->name;
        $whisky->price = $request->price;
        $whisky->image = $image;
        $whisky->drink_size = $request->drink_size;

        if($whisky->save()){
            if($oldImagePath) {
                Storage::delete($oldImagePath);
            }
        }
        return redirect('admin/whisky')->with('success', 'Whisky item has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $whisky = Whisky::findOrFail($id);
        $imagePath = $whisky->image;

        if($whisky->delete()){
            if($imagePath) {
                Storage::delete($imagePath);
            }
            return redirect('admin/whisky')->with('success', 'Whisky item deleted successfully');
        }
        else {
            return redirect('admin/whisky')->with('error', 'Failed to delete whisky item');
        }
    }
}
