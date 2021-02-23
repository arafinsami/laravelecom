<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.lists', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function save(Request $request)
    {

        $this->validate($request, [
            'brandName' => 'required',
        ]);

        $brand = new Brand();
        $brand->brandName = $request->brandName;
        $brand->created_at = Carbon::now();
        $brand->save();
        return redirect(route('admin.brand.lists'))->with('success', 'successfully created');
    }

    public function edit($brandId)
    {
        $brand = Brand::find($brandId);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'brandName' => 'required',
        ]);

        $brand = Brand::find($request->brandId);
        $brand->brandName = $request->brandName;
        $brand->status = $request->status;
        $brand->updated_at = Carbon::now();
        $brand->update();
        return redirect(route('admin.brand.lists'))->with('success', 'successfully updated');
    }

    public function delete($brandId)
    {
        $brand = Brand::find($brandId)->delete();
        return redirect(route('admin.brand.lists'))->with('delete', 'successfully deleted');
    }

    public function inactive($brandId)
    {
        Brand::find($brandId)->update(['status' => 0]);
        return redirect(route('admin.brand.lists'))->with('status', 'brand inactivated');
    }

    public function active($brandId)
    {
        Brand::find($brandId)->update(['status' => 1]);
        return redirect(route('admin.brand.lists'))->with('status', 'brand activated');
    }

}
