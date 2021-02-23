<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToWishlist($productId)
    {
        $wishList = Wishlist::where('productId', $productId)->where('userId', Auth::id())->first();
        if ($wishList) {
            return Redirect()->back()->with('cart', 'product already added on wishlist');
        } else {
            $wishList = new Wishlist();
            $wishList->userId = Auth::id();
            $wishList->productId = $productId;
            $wishList->save();
            return Redirect()->back()->with('cart', 'product added on wishlist');
        }
    }

    public function wishPage()
    {
        $wishlists = Wishlist::where('userId', Auth::id())->latest()->get();
        return view('frontend_pages.wishlist', compact('wishlists'));
    }

    public function delete($wishlistId)
    {
        Wishlist::where('id', $wishlistId)->where('userId', Auth::id())->delete();
        return Redirect()->back()->with('cart_delete', 'product removed from wishist');
    }
}
