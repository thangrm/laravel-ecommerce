<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function ViewCoupon(){
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.coupon-view', compact(['coupons']));
    }

    function StoreCoupon(Request $request){
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_quantity' => 'required',
            'coupon_active_date' => 'required',
            'coupon_expire_date' => 'required',
        ], [
            'coupon_name.required' => 'Enter coupon name',
            'coupon_discount.required'   => 'Enter coupon discount',
            'coupon_quantity.required'   => 'Enter coupon quantity',
            'coupon_active_date.required'   => 'Choose date',
            'coupon_expire_date.required'   => 'Choose date',
        ]);

        Coupon::create([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_quantity' => $request->coupon_quantity,
            'coupon_active_date' => $request->coupon_active_date,
            'coupon_expire_date' => $request->coupon_expire_date,
        ]);

        $notification = array(
            'message'    => 'Coupon Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function EditCoupon($id){

    }

    public function DeleteCoupon($id){
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        $notification = array(
                'message'    => 'Coupon Deleted Successfully',
                'alert-type' => 'info',
        );
        return redirect()->route('coupon.view')->with($notification);
    }
}
