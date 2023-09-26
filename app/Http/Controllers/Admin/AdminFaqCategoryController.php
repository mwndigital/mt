<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class AdminFaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = FaqCategory::all();

        return view('admin.pages.faqs.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.faqs.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        FaqCategory::create([
            'name' => $validated['name']
        ]);

        return redirect()->route('admin.faq-category.index')->with('success', 'New FAQ category added successfully');
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
        $category = FaqCategory::findOrFail($id);
        return view('admin.pages.faqs.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = FaqCategory::findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $category->update([
           'name' => $validated['name']
        ]);

        return redirect()->route('admin.faq-category.index')->with('success', 'FAQ Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = FaqCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.faq-category.index')->with('success', 'FAQ Category has been deleted successfully');
    }
}
