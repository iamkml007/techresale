<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Brand;
use App\Models\Category;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(){
        $products = Product::all();
        $brands = Brand::all();
        $categories = Category::all();
        if(Auth::check()){
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
            $cartCount = Cart::where('user_id', Auth::id())->count();
            $carts = Cart::where('user_id', Auth::id())->with('product')->get(); // Add with('product')
            $count = Wishlist::where('user_id',Auth::id())->count();
            $wishlists = Wishlist::where('user_id',Auth::id())->get();
        }else{
            $count = '';
            $wishlistCount = 0;
            $cartCount = 0;
            $carts = collect(); 
        }
        return view('viewwishlist', compact('products', 'cartCount', 'wishlists','wishlistCount', 'brands', 'categories', 'carts'));
    }
    public function create($id){
        $product =  Product::findOrFail($id);
        $wishlist = new Wishlist();
        $wishlist->user_id = Auth::id();
        $wishlist->product_id = $product->id;

        $wishlist->save();
        return redirect()->back()->with('wishlist_message','Product Added On Wishlist Successfully');

    }
    public function delete($id){
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        return redirect()->back()->with('wishlist_message','Cart Product Removed Successfully');

    }
}
