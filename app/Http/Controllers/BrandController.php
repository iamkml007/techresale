<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class BrandController extends Controller
{
    public function index(){
        return view('admin.addbrand');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:brands,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = $request->slug ?? Str::slug($request->name);
        $brand->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Create directory if not exists
            $destinationPath = public_path('brands');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            // Generate unique filename
            $imagename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Move the image
            $image->move($destinationPath, $imagename);
            $brand->image = $imagename;
        }
        $brand->save();
        return redirect()->back()->with('brand_message','Brand Saved Successfully');
            
    }
    public function viewAll(){
        $brands = Brand::all();
        return view('admin.viewbrand',compact('brands'));
    }
    public function edit($id){
        $brand = Brand::findOrFail($id);
        return view('admin.editbrand',compact('brand'));
    }
    public function update(Request $request,$id){
        $brand = Brand::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:brands,slug,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $brand->name = $request->name;
        $brand->slug = $request->slug ?? Str::slug($request->name);
        $brand->description = $request->description;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($brand->image && file_exists(public_path('brands/' . $brand->image))) {
                unlink(public_path('brands/' . $brand->image));
            }
            
            $image = $request->file('image');
            
            // Create directory if not exists
            $destinationPath = public_path('brands');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            // Generate unique filename
            $imagename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Move the image
            $image->move($destinationPath, $imagename);
            $brand->image = $imagename;
        }
        $brand->save();
        return redirect()->back()->with('brand_message','Brand Updated Successfully');
    }
    public function delete($id){
        $brand = Brand::findOrFail($id);
        $image_path = public_path('brands/'.$brand->image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $brand->delete();
        return redirect()->back()->with('brand_message','Brand Deleted Successfully');
    }
}