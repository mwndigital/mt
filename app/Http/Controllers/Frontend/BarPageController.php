<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BarPageContent;
use App\Models\BarRestaurantContent;
use App\Models\Menu;
use App\Models\Whisky;
use Illuminate\Http\Request;

class BarPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuStarters = Menu::where('category', 'Starters');
        $menuMains = Menu::where('category', 'Mains');
        $menuSides = Menu::where('category', 'Sides');
        $menuDesserts = Menu::where('category', 'desserts');
        $whiskies = Whisky::all();
        $content = BarPageContent::first();
        return view('frontend.pages.barPage', compact('menuStarters', 'menuMains', 'menuSides', 'menuDesserts', 'whiskies', 'content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
