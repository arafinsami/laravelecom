<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;

class CouponController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.lists',compact('coupons'));
    }

    public function create(){
        return view('admin.coupon.create');
    }

    public function save(Request $request) {
        $this-> validate($request,[
            'couponName' => 'required',
            'discount'   => 'required'
        ]);

        $coupon              = new Coupon();
        $coupon->couponName  = $request->couponName;
        $coupon->discount    = $request->discount;
        $coupon->created_at  = Carbon::now();
        $coupon->save();
        return redirect(route('admin.coupon.lists'))->with('success','successfully created');
    }

    public function edit($couponId){
        $coupon = Coupon::find($couponId);
        return view('admin.coupon.edit',compact('coupon'));
    }

    public function update(Request $request){
        $this-> validate($request,[
            'couponName' => 'required',
            'discount'   => 'required'
        ]);

        $coupon              = Coupon::find($request->couponId);
        $coupon->couponName  = $request->couponName;
        $coupon->discount  = $request->discount;
        $coupon->status      = $request->status;
        $coupon->updated_at  = Carbon::now();
        $coupon->update();
        return redirect(route('admin.coupon.lists'))->with('success','successfully updated');
    }

    public function delete($couponId){
        $coupon = Coupon::find($couponId)->delete();
        return redirect(route('admin.coupon.lists'))->with('delete','successfully deleted');
    }

    public function inactive($couponId){
        Coupon::find($couponId)->update(['status' => 0]);
        return redirect(route('admin.coupon.lists'))->with('status','coupon inactivated');
    }

    public function active($couponId){
        Coupon::find($couponId)->update(['status' => 1]);
        return redirect(route('admin.coupon.lists'))->with('status','coupon activated');
    }
}
