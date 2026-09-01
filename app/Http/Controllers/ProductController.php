<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; 

use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $categories =  Category::all();
        $brands =  Brand::all();
        return view('admin.addproduct',compact('categories','brands'));
    }
    public function store(Request $request){
    $product = new Product();
    $product->name = $request->name;
    $product->slug = $request->slug;
    $product->description = $request->description;
    $product->specifications = $request->specifications;
    $product->price = $request->price;
    $product->compare_price = $request->compare_price;
    $product->stock = $request->stock;
    $product->brand_id = $request->brand;
    $product->category_id = $request->category;
    $product->is_published = $request->has('is_published');
    $product->condition = $request->condition;
    $product->grade = $request->grade;
    $product->battery_health = $request->battery_health;
    $product->accessories_included = $request->accessories_included;
    if ($request->hasFile('images')) {
                $images = [];
                $destinationPath = public_path('products');
                
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                
                foreach ($request->file('images') as $image) {
                    $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $image->move($destinationPath, $filename);
                    
                    $images[] = 'products/' . $filename;
                }
                
                $product->images = $images; 
            }
            
            $product->save();
        return redirect()->back()->with('product_message','Product Saved Successfully');
    }
    public function viewAll(){
        $products = Product::paginate(4);
        return view('admin.viewproduct',compact('products'));
    }
    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.editproduct',compact('product','categories','brands'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->specifications = $request->specifications;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->stock = $request->stock;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->is_published = $request->has('is_published');
        $product->condition = $request->condition;
        $product->grade = $request->grade;
        $product->battery_health = $request->battery_health;
        $product->accessories_included = $request->accessories_included;
        
        // Handle multiple images
        if ($request->hasFile('images')) {
            // Delete old images
            if ($product->images) {
                $oldImages = is_array($product->images) ? $product->images : json_decode($product->images, true);
                if ($oldImages) {
                    foreach ($oldImages as $oldImage) {
                        $oldImagePath = public_path($oldImage);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }
            }
            
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('products'), $filename);
                $images[] = 'products/' . $filename;
            }
            $product->images = $images;
        }
        
        $product->save();
        
        return redirect()->back()->with('product_message', 'Product Updated Successfully');
    }

public function delete($id) {
    $product = Product::findOrFail($id);
    $image_path = public_path('products/' . $product->image);
    
    if(file_exists($image_path) && is_file($image_path)) {
        if(!unlink($image_path)) {
            // Log error but continue with deletion
            \Log::error('Could not delete image: ' . $image_path);
        }
    }
    
    $product->delete();
    return redirect()->back()->with('product_message','Product Deleted Successfully');
}
    public function search(Request $request){
        $products = Product::where('name','LIKE','%'.$request->search.'%')->
        orWhere('description','LIKE','%'.$request->search.'%')->
        orWhere('category','LIKE','%'.$request->search.'%')->
        paginate(2);
        return view('admin.viewproduct',compact('products'));
    }
    
}