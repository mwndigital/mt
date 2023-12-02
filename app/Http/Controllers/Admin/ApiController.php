<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomGalleries;

class ApiController extends Controller
{
    public function removeImage(Request $request)
    {

        $image = RoomGalleries::findOrFail($request->id);

        // remove from storage disk and database
        if ($image) {
            \Storage::delete($image->image);
            $image->delete();
        }

        return response()->json([
            'success' => true,
        ]);
    }

    // Upload image
    public function uploadImage(Request $request)
    {
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        // ]);

        $imageName = time() . '.' . $request->image->extension();

        $imgUrl = $request->image->store('public/uploads/rooms');

        RoomGalleries::create([
            'room_id' => $request->id,
            'image' => $imgUrl,
        ]);

        return response()->json([
            'success' => true,
            'image' => $imageName,
        ]);
    }

    // Sort images
    public function sortImages(Request $request)
    {
        RoomGalleries::setNewOrder($request->sort_order);
        return response()->json(['success' => true]);
    }
}
