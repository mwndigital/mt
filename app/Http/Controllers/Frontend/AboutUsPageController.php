<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutPageContent;
use Illuminate\Http\Request;

class AboutUsPageController extends Controller
{
    public function index() {
        $apc = AboutPageContent::first();
        return view('frontend.pages.aboutUs', compact('apc'));
    }
}
