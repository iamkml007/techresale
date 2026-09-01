<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $brands = Brand::all();
        $categories = Category::all();
        
        if(Auth::check()){
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
            $cartCount = Cart::where('user_id', Auth::id())->count();
            $carts = Cart::where('user_id', Auth::id())->with('product')->get(); // Add with('product')
        } else {
            $wishlistCount = 0;
            $cartCount = 0;
            $carts = collect(); // Empty collection
        }
        
        return view('viewcart', compact('products', 'cartCount', 'wishlistCount', 'brands', 'categories', 'carts'));
    }
    public function create($id){
        $product =  Product::findOrFail($id);
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->product_id = $product->id;

        $cart->save();
        return redirect()->back()->with('cart_message','Product Added On Cart Successfully');

    }
    public function delete($id){
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->back()->with('cart_message','Cart Product Removed Successfully');

    }
}
