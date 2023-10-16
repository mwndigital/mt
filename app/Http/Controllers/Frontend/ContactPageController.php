<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormSubmissionStoreRequest;
use App\Mail\AdminContactFormSubmissionMail;
use App\Models\ContactFormSubmissions;
use App\Models\ContactPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = ContactPageContent::first();
        return view('frontend.pages.contactPage', compact('content'));
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
    public function store(ContactFormSubmissionStoreRequest $request)
    {
        $contactFormSubmissions = ContactFormSubmissions::create([
            'name' => $request->name,
            'email' => $request->email,
            'yourMessage' => $request->yourMessage,
        ]);

        Mail::to($contactFormSubmissions->email)->send(new AdminContactFormSubmissionMail($contactFormSubmissions));

        return redirect()->back()->with('success', 'Your form submission has been sent successfully.  One of the team will be in touch with you shortly.');
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
