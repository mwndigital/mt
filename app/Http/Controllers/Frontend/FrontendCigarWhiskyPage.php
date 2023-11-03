<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CigarWhiskyPageContent;
use Illuminate\Http\Request;

class FrontendCigarWhiskyPage extends Controller
{
    public function index(){

        $content = CigarWhiskyPageContent::first();

        return view('frontend.pages.cigarWhiskyPage', compact('content'));
    }
}
