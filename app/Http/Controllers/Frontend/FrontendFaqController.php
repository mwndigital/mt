<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\FaqsPage;
use Illuminate\Http\Request;

class FrontendFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = FaqCategory::orderBy('order', 'ASC')->get();
        $content = FaqsPage::first();

        return view('frontend.pages.faqsPage', compact('categories', 'content'));
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
