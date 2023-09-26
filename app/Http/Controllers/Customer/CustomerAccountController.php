<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Monarobase\CountryList\CountryList;

class CustomerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
        $profile = User::findOrFail($id);

        return view('customer.pages.my-account.index', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profile = User::findOrFail($id);
        $countryList = new CountryList();
        $countries = $countryList->getList('en');

        return view('customer.pages.my-account.edit', compact('profile', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['nullable', 'tel', 'max:14'],
            'address_line_one' => ['nullable', 'string', 'max:255'],
            'address_line_two' => ['nullable', 'string', 'max:255'],
            'town_city' => ['nullable', 'string', 'max:255'],
            'postcode' => ['nullable', 'string', 'max:10'],
            'country' => ['nullable', 'string', 'max:100'],
            'dietary_information' => ['nullable', 'string', 'max:2000'],
        ]);

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email']
        ]);

        $user->userDetails()->updateOrCreate([
            'user_id' => $user->id,
            'phone_number' => $validated['phone_number'],
            'address_line_one' => $validated['address_line_one'],
            'address_line_two' => $validated['address_line_two'],
            'town_city' => $validated['town_city'],
            'postcode' => $validated['postcode'],
            'country' => $validated['country'],
            'dietary_information' => $validated['dietary_information'],
        ]);

        return redirect()->back()->with('success', 'Your information has been updated successfully');
    }

    public function changePasswordView(string $id) {
        $profile = User::findOrFail($id);

        return view('customer.pages.my-account.password-change', compact('profile'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
