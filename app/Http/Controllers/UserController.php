<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Wishlist;


class UserController extends Controller
{
    public function index(){
        $products = Product::all();
        $brands = Brand::all();
        $categories = Category::all();
        if(Auth::check() && Auth::user()->user_type=='user'){
            $cartCount = Cart::where('user_id',Auth::id())->count();
            $wishlistCount = Wishlist::where('user_id',Auth::id())->count();
            $totalOrders = Order::count();
            return view('master',compact('products','cartCount','wishlistCount','brands','categories','totalOrders'));
        }else if(Auth::check() && Auth::user()->user_type=='admin'){
            $cart = Cart::where('user_id',Auth::id())->count();
            $totalUser = User::where('user_type','user')->count();
            $totalOrders = Order::count();
            return view('admin.dashboard',compact('totalUser','cart','totalOrders'));
        }
    }
    public function home(){
        $products = Product::all();
        $brands = Brand::all();
        $categories = Category::all();
        if(Auth::check()){
            $cartCount = Cart::where('user_id',Auth::id())->count();
            $wishlistCount = Wishlist::where('user_id',Auth::id())->count();
        }else{
            $cartCount = '';
            $wishlistCount = '';
            return view('home',compact('products','cartCount','wishlistCount','brands','categories'));
        }
        return view('home',compact('products','cartCount','wishlistCount','brands','categories'));
    }
    public function view($id){
        $products = Product::all();
        $brands = Brand::all();
        $categories = Category::all();
        if(Auth::check()){
            $cartCount = Cart::where('user_id',Auth::id())->count();
            $wishlistCount = Wishlist::where('user_id',Auth::id())->count();
            $count = Cart::where('user_id',Auth::id())->count();
        }else{
            $cartCount = 0;
            $wishlistCount = 0;
            $count = 0;
        }
        $product = Product::findOrFail($id);
        return view('view-product',compact('products','product','cartCount','wishlistCount','brands','categories'));
    }
    public function payment()
   {
        return view('payment');
   }
   public function master()
   {
    $products = Product::all();
        $brands = Brand::all();
        $categories = Category::all();
        if(Auth::check()){
            $cartCount = Cart::where('user_id',Auth::id())->count();
            $wishlistCount = Wishlist::where('user_id',Auth::id())->count();
        }else{
            $cartCount = '';
            $wishlistCount = '';
            return view('master',compact('products','cartCount','wishlistCount','brands','categories'));
        }
        return view('master',compact('products','cartCount','wishlistCount','brands','categories'));
        // return view('master');
   }
    
}

