<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Cart;
use App\Coupon;

class CartController extends Controller {

    public function addToCart(Request $request,$productId) {

        $cart = Cart::where('productId',$productId)->where('userIp',request()->ip())->first();
        if ($cart) {
            Cart::where('productId',$productId)->where('userIp',request()->ip())->increment('qty');
            return Redirect()->back()->with('cart','product added on cart');
        }else{
            $cart            = new Cart();
            $cart->productId = $productId;
            $cart->qty       = 1;
            $cart->price     = $request->price;
            $cart->userIp    = request()->ip();
            $cart->save();
            return Redirect()->back()->with('cart','product added on cart');
        }
    }

    public function viewCart(){
        $carts = Cart::where('userIp',request()->ip())->latest()->get();
        $subtotal = Cart::all()->where('userIp',request()->ip())->sum(function($t){
            return $t->price * $t->qty;
         });
        return view('frontend_pages.cart',compact('carts','subtotal'));
    }

    public function update(Request $request,$cartId){
        Cart::where('id',$cartId)->where('userIp',request()->ip())->update([
            'qty' => $request->qty,
        ]);
        return Redirect()->back()->with('cart_update','cart updated');
    }

    public function delete($cartId){
        Cart::where('id',$cartId)->where('userIp',request()->ip())->delete();
        return Redirect()->back()->with('cart_delete','cart removed');
    }

    public function applyCoupon(Request $request){

        $couponCheck = Coupon::where('couponName',$request->couponName)->first();

        if ($couponCheck) {  
            $subtotal = Cart::all()->where('userIp',request()->ip())->sum(function($t){
            return $t->price * $t->qty;
            });

            Session::put('coupon',[
                'couponName'      => $couponCheck->couponName,
                'discount'        => $couponCheck->discount,
                'discount_amount' => $subtotal * ($couponCheck->discount/100),
            ]);
            return Redirect()->back()->with('cart_update','successfully coupon applied');
        }else{
            return Redirect()->back()->with('cart_delete','Invalid Coupon');
        }
    }

    public function deleteCoupon(){
        if (Session::has('coupon')) {
           session()->forget('coupon');
           return Redirect()->back()->with('cart_delete','coupon removed successfully');
        }
    }
}
