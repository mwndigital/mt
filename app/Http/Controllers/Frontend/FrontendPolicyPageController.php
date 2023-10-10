<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PolicyPages;
use Illuminate\Http\Request;

class FrontendPolicyPageController extends Controller
{
    public function show($slug) {
        $policyPage = PolicyPages::where('slug', $slug)->firstOrFail();

        return view('frontend.pages.policyPages', compact('policyPage'));
    }
}
