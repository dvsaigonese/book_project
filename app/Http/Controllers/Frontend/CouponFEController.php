<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CouponFEController extends Controller
{
    public function addCoupon(Request $request)
    {
        $code = $request->get('code');

        $coupon = Coupon::where('code', $code)
            ->where('status', 1)
            ->first();

        $isUsed = DB::table('user_has_coupons')
            ->where('user_id', '=', Auth::id())
            ->where('coupon_id', '=', $coupon->id)
            ->exists();

        if ($coupon && !$isUsed) {
            $couponGet = [
                'code' => $coupon->code,
                'coupon_id' => $coupon->id,
                'new_price' => $coupon->discount($request->get('total')),
                'discount' => $coupon->getDiscountText(),
                'discount_value' => $coupon->get_discount_value($request->get('total')),
            ];

            return json_encode($couponGet);

        } else {
            return redirect()->back()->with('warning', 'The code is wrong or used already. Please try again.');
        }
    }

}
