<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomStoreRequest;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Rooms::all();
        return view('admin.pages.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomStoreRequest $request)
    {
        $image = $request->file('featured_image')->store('public/uploads/rooms');

        Rooms::create([
            'name' => $request->name,
            'room_type' => $request->room_type,
            'adult_cap' => $request->adult_cap,
            'child_cap' => $request->child_cap,
            'bathroom_type' => $request->bathroom_type,
            'price_per_night' => $request->price_per_night,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'featured_image' => $image,
        ]);
        return redirect('admin/rooms')->with('success', 'New Room has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Rooms::find($id);
        return view('admin.pages.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Rooms::findOrFail($id);

        return view('admin.pages.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = Rooms::findOrFail($id);

        $oldImagePath = $room->featured_image;

        $image = $request->file('featured_image')->store('public/uploads/rooms');

        $room->name = $request->name;
        $room->room_type = $request->room_type;
        $room->adult_cap = $request->adult_cap;
        $room->child_cap = $request->child_cap;
        $room->bathroom_type = $request->bathroom_type;
        $room->price_per_night = $request->price_per_night;
        $room->description = $request->description;
        $room->short_description = $request->short_description;
        $room->featured_image = $image;

        if($room->save()){
            if($oldImagePath){
                Storage::delete($oldImagePath);
            }
        }
        return redirect('admin/rooms')->with('success', 'Room has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Rooms::findOrFail($id);
        $imagePath = $room->featured_image;

        if($room->delete()) {
            if($imagePath){
                Storage::delete($imagePath);
            }
            return redirect('admin/rooms')->with('success', 'Room has been deleted successfully');
        }
        else {
            return redirect('admin/rooms')->with('error', 'Failed to delete room');
        }
    }
}
