<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class MainController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if (!$coupon) {
            return response()->json([
                'status' => false,
                'message' => 'Coupon does not exist'
            ]);
        }

        $booking = $request->session()->get('booking');
        $booking->coupon_id = $coupon->id;
        $request->session()->put('booking', $booking);

        return response()->json([
            'status' => true,
            'message' => 'Coupon applied successfully',
        ]);
    }
}
