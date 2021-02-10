<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller {
    
    public function __construct() {
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.lists',compact('categories'));
    }

    public function save(Request $request) {

        $this-> validate($request,[
            'categoryName' => 'required',
        ]);

        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->save();
        return redirect(route('admin/category-list'))->with('success','category successfully saved');
    }

    public function edit($categoryId){
        $category = Category::find($categoryId);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request){

        $this-> validate($request,[
            'categoryName' => 'required',
        ]);

        $category = Category::find($request->categoryId);
        $category->categoryName = $request->categoryName;
        $category->status = $request->status;
        $category->save();
        return redirect(route('admin.category-list'))->with('success','category successfully updated');
    }

    public function delete($categoryId){
        $category = Category::find($categoryId)->delete();
        return redirect(route('admin.category-list'))->with('delete','category successfully deleted');
    }
}
