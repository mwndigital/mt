<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\FaqsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminFaqsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.pages.faqs.page-content.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.faqs.page-content.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $seoImage = NULL;
        $seoImagePath = NULL;
        $validated = $request->validate([
            'main_title' => ['required', 'string', 'max:255'],
            'sub_title' => ['nullable', 'string', 'max:15000'],
            'seo_title' => ['nullable', 'string', 'max:500'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image',  'mimes:jpg,jpeg,png,svg,webp'],
            'seo_keywords' => ['nullable', 'string', 'max:255']
        ]);
        if($request->hasFile('seo_image')){
            $seoImage = $validated['seo_image'];
            $fileName = time().'_'.$seoImage->getClientOriginalName();
            $folder = 'public/pages/faqs-page';

            $seoImagePath = $seoImage->storeAs($folder, $fileName);
        }
        FaqsPage::create([
            'main_title' => $validated['main_title'],
            'sub_title' => $validated['sub_title'],
            'slug' => Str::slug($validated['main_title']),
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'seo_image' => $seoImagePath,
            'seo_keywords' => $validated['seo_keywords'],
        ]);
        return redirect()->back()->with('success', 'FAQ page content created successfully');
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
        $content = FaqsPage::findOrFail($id);

        return view('admin.pages.faqs.page-content.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $content = FaqsPage::findOrFail($id);

        $validated = $request->validate([
            'main_title' => ['required', 'string', 'max:255'],
            'sub_title' => ['nullable', 'string', 'max:15000'],
            'seo_title' => ['nullable', 'string', 'max:500'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image',  'mimes:jpg,jpeg,png,svg,webp'],
            'seo_keywords' => ['nullable', 'string', 'max:255']
        ]);

        $oldSeoImage = $content->seo_image;
        $seoImagePath = NULL;

        if($request->hasFile('seo_image')){
            $seoImage = $request->file('seo_image');
            $fileName = time().'_'.$seoImage->getClientOriginalName();
            $folder = 'public/pages/faqs-page';

            $seoImagePath = $seoImage->storeAs($folder, $fileName);

            if($oldSeoImage) {
                Storage::delete($oldSeoImage);
            }
        }
        $content->update([
            'main_title' => $validated['main_title'],
            'sub_title' => $validated['sub_title'],
            'slug' => $content->slug,
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'seo_image' => $seoImagePath,
            'seo_keywords' => $validated['seo_keywords'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
