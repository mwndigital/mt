<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomePageContent;
use App\Models\Rooms;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hpcontent = HomepageContent::first();
        $rooms = Rooms::all();
        return view('frontend.pages.homepage', compact('rooms', 'hpcontent'));
    }

}
