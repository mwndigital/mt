<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class MainController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $couponCode = $request->couponCode;
        $coupon = Coupon::where('code', $couponCode)->first();

        // Check if coupon exists
        if (!$coupon) {
            return response()->json([
                'status' => false,
                'message' => 'Coupon does not exist'
            ]);
        }

        // Check if the coupon is valid using a method in the Coupon model
        if (!$coupon->isValid()) {
            return response()->json([
                'status' => false,
                'message' => 'Coupon is invalid'
            ]);
        }

        // If the coupon is valid, proceed to apply it to the booking
        $booking = $request->session()->get('booking');
        $booking->coupon_id = $coupon->id;
        $request->session()->put('booking', $booking);

        return response()->json([
            'status' => true,
            'message' => 'Coupon applied successfully',
            'total' => $booking->getTotalAmount(),
            'discount' => $booking->discount,
        ]);
    }
}
