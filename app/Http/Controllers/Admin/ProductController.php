<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class ProductController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index(){
        $products = Product::latest()->get();
        return view('admin.product.lists',compact('products'));
    }

    public function create(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.product.create',compact('categories','brands'));
    }

    public function save(Request $request) {

        $request->validate([
            'productName'         => 'required|max:255',
            //'productSlug'         => 'required|max:255',
            'productCode'         => 'required|max:255',
            'productQuantity'     => 'required|max:255',
            'categoryId'          => 'required|max:255',
            'brandId'             => 'required|max:255',
            'shortDescription'    => 'required',
            'longDescription'     => 'required',
            'price'               => 'required|max:255',
            'imageOne'            => 'required|mimes:jpg,jpeg,png,gif',
            'imageTwo'            => 'required|mimes:jpg,jpeg,png,gif',
            'imageThree'          => 'required|mimes:jpg,jpeg,png,gif',
        ],[
            'categoryId.required' => 'select category name',
            'brandId.required' => 'select brand name',
        ]);

        $imageOne = $request->file('imageOne');                
        $name_gen = hexdec(uniqid()).'.'.$imageOne->getClientOriginalExtension();
        Image::make($imageOne)->resize(270,270)->save('frontend/upload/'.$name_gen);       
        $imgUrl1 = 'frontend/upload/'.$name_gen;

        $imageTwo = $request->file('imageTwo');                
        $name_gen = hexdec(uniqid()).'.'.$imageTwo->getClientOriginalExtension();
        Image::make($imageTwo)->resize(270,270)->save('frontend/upload/'.$name_gen);       
        $imgUrl2 = 'frontend/upload/'.$name_gen;

        $imageThree = $request->file('imageThree');                
        $name_gen = hexdec(uniqid()).'.'.$imageThree->getClientOriginalExtension();
        Image::make($imageThree)->resize(270,270)->save('frontend/upload/'.$name_gen);       
        $imgUrl3 = 'frontend/upload/'.$name_gen;

        $product = new Product();
        $product->productName      = $request->productName;
        $product->productSlug      = $request->productSlug;
        $product->productCode      = $request->productCode;
        $product->productQuantity  = $request->productQuantity;
        $product->categoryId       = $request->categoryId;
        $product->brandId          = $request->brandId;
        $product->shortDescription = $request->shortDescription;
        $product->longDescription  = $request->longDescription;
        $product->price            = $request->price;
        $product->imageOne         = $imgUrl1;
        $product->imageTwo         = $imgUrl2;
        $product->imageThree       = $imgUrl3;
        $product->created_at       = Carbon::now();
        $product->save();
        return redirect(route('admin.product.lists'))->with('success','successfully created');
    }

    public function edit($productId){
        $product = Product::findOrFail($productId);
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.product.edit',compact('product','categories','brands'));
    }

    public function updateProduct(Request $request){

        $productId = $request->productId;

        Product::findOrFail($productId)->Update([
            'categoryId' => $request->categoryId,
            'brandId' => $request->brandId,
            'productName' => $request->productName,
            'productSlug' => strtolower(str_replace(' ','-',$request->productName)),
            'productCode' => $request->productCode,
            'price' => $request->price,
            'productQuantity' => $request->productQuantity,
            'shortDescription' => $request->shortDescription,
            'longDescription' => $request->longDescription,
            'update_at' => Carbon::now(),
        ]);

        return redirect(route('admin.product.lists'))->with('success','successfully updated');
    }

    public function updateImage(Request $request){
        
        $product_id = $request->id;
        $old_one = $request->img_one;
        $old_two = $request->img_two;
        $old_three = $request->img_three;
        if ($request->has('image_one') && $request->has('image_two')) {
            unlink($old_one);
            unlink($old_two);
            $imag_one = $request->file('image_one');                
             $name_gen = hexdec(uniqid()).'.'.$imag_one->getClientOriginalExtension();
             Image::make($imag_one)->resize(270,270)->save('fontend/img/product/upload/'.$name_gen);       
             $img_url1 = 'fontend/img/product/upload/'.$name_gen;
 
             Product::findOrFail($product_id)->update([
                 'image_one' => $img_url1,
                 'updated_at' => Carbon::now(),
             ]);

             $imag_one = $request->file('image_two');                
             $name_gen = hexdec(uniqid()).'.'.$imag_one->getClientOriginalExtension();
             Image::make($imag_one)->resize(270,270)->save('fontend/img/product/upload/'.$name_gen);       
             $img_url1 = 'fontend/img/product/upload/'.$name_gen;
 
             Product::findOrFail($product_id)->update([
                 'image_two' => $img_url1,
                 'updated_at' => Carbon::now(),
             ]);
 
             return Redirect()->route('manage-products')->with('success','image successfully Updated');
         }
         
        if ($request->has('image_one')) {
           unlink($old_one);
           $imag_one = $request->file('image_one');                
            $name_gen = hexdec(uniqid()).'.'.$imag_one->getClientOriginalExtension();
            Image::make($imag_one)->resize(270,270)->save('fontend/img/product/upload/'.$name_gen);       
            $img_url1 = 'fontend/img/product/upload/'.$name_gen;

            Product::findOrFail($product_id)->update([
                'image_one' => $img_url1,
                'updated_at' => Carbon::now(),
            ]);

            return Redirect()->route('manage-products')->with('success','image successfully Updated');
        }

        if ($request->has('image_two')) {
            unlink($old_two);
            $imag_one = $request->file('image_two');                
             $name_gen = hexdec(uniqid()).'.'.$imag_one->getClientOriginalExtension();
             Image::make($imag_one)->resize(270,270)->save('fontend/img/product/upload/'.$name_gen);       
             $img_url1 = 'fontend/img/product/upload/'.$name_gen;
 
             Product::findOrFail($product_id)->update([
                 'image_two' => $img_url1,
                 'updated_at' => Carbon::now(),
             ]);
 
             return Redirect()->route('manage-products')->with('success','image successfully Updated');
         }

         if ($request->has('image_three')) {
            unlink($old_three);
            $imag_one = $request->file('image_three');                
             $name_gen = hexdec(uniqid()).'.'.$imag_one->getClientOriginalExtension();
             Image::make($imag_one)->resize(270,270)->save('fontend/img/product/upload/'.$name_gen);       
             $img_url1 = 'fontend/img/product/upload/'.$name_gen;
 
             Product::findOrFail($product_id)->update([
                 'image_three' => $img_url1,
                 'updated_at' => Carbon::now(),
             ]);
 
             return Redirect()->route('manage-products')->with('success','image successfully Updated');
         }
    }
    
    public function delete($productId) {

        $product    = Product::findOrFail($productId);
        $imageOne   = $product->imageOne;
        $imageTwo   = $product->imageTwo;
        $imageThree = $product->imageThree;

        unlink($imageOne);
        unlink($imageTwo);
        unlink($imageThree);

        Product::findOrFail($productId)->delete();
        return redirect(route('admin.product.lists'))->with('delete','successfully deleted');
    }

    public function inactive($productId){
        Product::findOrFail($productId)->update(['status' => 0]);
        return redirect(route('admin.product.lists'))->with('status','product inactive');
    }

    public function active($productId){
        Product::findOrFail($productId)->update(['status' => 1]);
        return redirect(route('admin.product.lists'))->with('status','product activated');
    }
}
