<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleOne = Role::where('name', 'admin')->first();
        $roleTwo = Role::where('name', 'staff')->first();
        $roleThree = Role::where('name', 'super admin')->first();

        $users = User::role('staff') // Include users with the 'staff' role
        ->whereDoesntHave('roles', function ($query) use ($roleOne, $roleThree) {
            $query->whereIn('name', ['admin', 'super admin']);
        })
            ->get();

        $superAdmins = User::role($roleThree)->get();


        return view('admin.pages.users.index', compact('users', 'superAdmins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'super admin')
            ->where('name', '!=', 'customer')
            ->get();
        return view('admin.pages.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
           'first_name' => ['required', 'string', 'max:100'],
           'last_name' => ['required', 'string', 'max:100'],
           'email' => ['required', 'email', 'max:100', 'unique:users'],
           'password' => ['required_with:confirmation_password', 'same:confirmation_password', 'min:6', 'max:25'],
            'role' => ['required']
        ]);

        $role = $validated['role'];

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($role),
        ]);

        $user->assignRole($validated['role']);

        return redirect('admin/users')->with('success', "New user added successfully");
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
