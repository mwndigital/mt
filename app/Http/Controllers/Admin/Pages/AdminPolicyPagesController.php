<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\PolicyPageStoreRequest;
use App\Models\PolicyPages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPolicyPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $policyPages = PolicyPages::all();
        return view('admin.pages.policy-pages.index', compact('policyPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.policy-pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PolicyPageStoreRequest $request)
    {
        PolicyPages::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'main_content' => $request->main_content,
        ]);

        return redirect('admin/pages/policy-pages')->with('success', 'New Policy Page created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $policyPage = PolicyPages::findOrFail($id);

        return view('admin.pages.policy-pages.show', compact('policyPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $policyPage = PolicyPages::findOrFail($id);

        return view('admin.pages.policy-pages.edit', compact('policyPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PolicyPageStoreRequest $request, string $id)
    {
        $policyPage = PolicyPages::findOrFail($id);

        $policyPage->title = $request->title;
        $policyPage->slug = $policyPage->slug;
        $policyPage->main_content = $request->main_content;
        $policyPage->save();

        return redirect('admin/pages/policy-pages')->with('success', 'Policy page has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $policyPage = PolicyPages::findOrFail($id);

        $policyPage->delete();

        return redirect('admin/pages/policy-pages')->with('success', 'Policy Page has been deleted successfully');
    }
}
