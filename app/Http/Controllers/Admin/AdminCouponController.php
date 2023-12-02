<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class AdminCouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->get();
        return view('admin.pages.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.pages.coupons.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(Coupon::$rules);

        Coupon::create($validatedData);
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully');
    }

    public function show(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.pages.coupons.show', compact('coupon'));
    }

    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.pages.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            ...Coupon::$rules,
            'code' => 'required|unique:coupons,code,' . $id,
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update($validatedData);
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully');
    }

    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully');
    }
}
