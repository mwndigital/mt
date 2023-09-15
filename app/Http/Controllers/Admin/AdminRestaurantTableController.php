<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantTableStoreRequest;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class AdminRestaurantTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = RestaurantTable::all();
        return view('admin.pages.restaurant.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.restaurant.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantTableStoreRequest $request)
    {
        RestaurantTable::create([
            'name' => $request->name,
            'no_of_seats' => $request->no_of_seats,
            'status' => $request->status,
            'bookable_by_guests' => $request->bookable_by_guests,
        ]);

        return redirect('admin/restaurant-tables')->with('success', 'New table has been added successfully');
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
        $table = RestaurantTable::findOrFail($id);

        return view('admin.pages.restaurant.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantTableStoreRequest $request, string $id)
    {
            RestaurantTable::where('id', $id)->update([
            'name' => $request->name,
            'no_of_seats' => $request->no_of_seats,
            'status' => $request->status,
            'bookable_by_guests' => $request->bookable_by_guests,
        ]);

        return redirect('admin/restaurant-tables')->with('success', 'Table has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $table = RestaurantTable::findOrFail($id);

        $table->delete();

        return redirect('admin/restaurant-tables')->with('success', 'Table has been deleted successfully');
    }
}
