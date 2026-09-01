<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.addcategory');
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug ?? Str::slug($request->name);
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            $destinationPath = public_path('categories');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $imagename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            $image->move($destinationPath, $imagename);
            $category->image = $imagename;
        }
        $category->save();
        return redirect()->back()->with('category_message','Category Saved Successfully');
    }
    public function view(){
        $category = Category::all();
        return view('admin.viewcategory',compact('category'));
    }
    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.editcategory',compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category->name = $request->name;
        $category->slug = $request->slug ?? Str::slug($request->name);
        $category->description = $request->description;
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image ONLY if it exists and is not empty
            if ($category->image && $category->image != '') {
                $oldImagePath = public_path('categories/' . $category->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $image = $request->file('image');
            
            // Create directory if not exists
            $destinationPath = public_path('categories');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            // Generate unique filename
            $imagename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Move the image
            $image->move($destinationPath, $imagename);
            $category->image = $imagename;
        }
        
        $category->save();
        
        return redirect()->back()->with('updatecategory_message', 'Category Updated Successfully');
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        
        // Only delete image if it exists and is not empty
        if ($category->image && $category->image != '') {
            $image_path = public_path('categories/' . $category->image);
            if (file_exists($image_path) && is_file($image_path)) {
                unlink($image_path);
            }
        }
        
        $category->delete();
        
        return redirect()->back()->with('deletecategory_message', 'Category Deleted Successfully');
    }
}
