<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;


class CategoryController extends Controller {
    
    public function __construct() {
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.lists',compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function save(Request $request) {

        $this-> validate($request,[
            'categoryName' => 'required'
        ]);

        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->created_at = Carbon::now();
        $category->save();
        return redirect(route('admin.category.lists'))->with('success','successfully created');
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
        $category->updated_at = Carbon::now();
        $category->update();
        return redirect(route('admin.category.lists'))->with('success','successfully updated');
    }

    public function delete($categoryId){
        $category = Category::find($categoryId)->delete();
        return redirect(route('admin.category.lists'))->with('delete','successfully deleted');
    }

    public function inactive($categoryId){
        Category::find($categoryId)->update(['status' => 0]);
        return redirect(route('admin.category.lists'))->with('statusupdated','category inactive');
    }

    public function active($categoryId){
        Category::find($categoryId)->update(['status' => 1]);
        return redirect(route('admin.category.lists'))->with('statusupdated','category active');
    }
}
