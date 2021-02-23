<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class IndexController extends Controller {

    public function index(){
        $products       = Product::where('status',1)->latest()->get();
        $latestProducts = Product::where('status',1)->latest()->limit(4)->get();
        $categories     = Category::where('status',1)->latest()->get();
        return view('frontend_pages.index',compact('products','categories','latestProducts'));
    }

    // ----------- product details ---------
    public function productDetails($productId){
        $product         = Product::findOrFail($productId);
        $categoryId      = $product->categoryId;
        $relatedProducts = Product::where('categoryId',$categoryId)->where('id','!=',$productId)->latest()->get();
        return view('frontend_pages.product-deatails',compact('product','relatedProducts'));
    }
}
