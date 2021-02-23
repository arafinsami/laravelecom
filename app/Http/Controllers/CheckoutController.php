<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller {

    public function index() {
        if (Auth::check()) {
            $carts = Cart::latest()->get();
            $subtotal = Cart::all()->where('userIp', request()->ip())->sum(function ($t) {
                return $t->price * $t->qty;
            });
            return view('frontend_pages.checkout', compact('carts', 'subtotal'));
        } else {
            return redirect()->route('login');
        }
    }
}
