<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Cart;
use App\Coupon;

class CartController extends Controller {

    public function addToCart(Request $request,$productId){

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

    public function quantityUpdate(Request $request,$cartId){
        Cart::where('id',$cartId)->where('userIp',request()->ip())->update([
            'qty' => $request->qty,
        ]);
        return Redirect()->back()->with('cart_update','quantity updated');
    }

    public function destroy($cartId){
        Cart::where('id',$cartId)->where('userIp',request()->ip())->delete();
        return Redirect()->back()->with('cart_delete','product from cart Removed');
    }


}
