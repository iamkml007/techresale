<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhonepeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\WishlistController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/', [UserController::class,'home'])->name('home');
Route::get('/dashboard', [UserController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/view-product/{id}', [UserController::class,'view'])->name('view-product');

Route::middleware('auth')->group(function () {
    Route::get('/master', [UserController::class,'master'])->middleware(['auth', 'verified'])->name('master');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('/addwishlist/{id}', [WishlistController::class, 'create'])->name('add.wishlist');
    Route::get('/wishlist-delete/{id}', [WishlistController::class, 'delete'])->name('wishlist-delete');

    Route::get('/addcart/{id}', [CartController::class, 'create'])->name('add.cart');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart-delete/{id}', [CartController::class, 'delete'])->name('cart-delete');
    Route::post('/order', [OrderController::class, 'store'])->name('order');
    Route::get('/myorder', [OrderController::class, 'myorder'])->name('myorder');
    Route::get('/my-orders', [OrderController::class, 'usermyorder'])->name('myorders');

    // Route::get('/',[PhonepeController::class,'index'])->name('home');
    // Route::post('/phonepe/payment', [PhonepeController::class, 'payment'])->name('phonepe.payment');
    // Route::post('/phonepe/success', [PhonepeController::class, 'success'])->name('phonepe.success');
    // Route::get('/payment', [UserController::class, 'payment'])->name('payment');

});

Route::middleware('admin')->group(function () {
    Route::get('/add-brand', [BrandController::class, 'index'])->name('add-brand');
    Route::post('/add-brand', [BrandController::class, 'store'])->name('store-brand');
    Route::get('/view-brand', [BrandController::class, 'viewAll'])->name('view-brand');
    Route::get('/edit-brand/{id}', [BrandController::class, 'edit'])->name('edit-brand');
    Route::post('/update-brand/{id}', [BrandController::class, 'update'])->name('update-brand');
    Route::get('/delete-brand/{id}', [BrandController::class, 'delete'])->name('delete-brand');

    Route::get('/add-category', [CategoryController::class, 'index'])->name('add-category');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('add-category');
    Route::get('/view-category', [CategoryController::class, 'view'])->name('view-category');
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit-category');
    Route::post('/update-category/{id}', [CategoryController::class, 'update'])->name('update-category');
    Route::get('/delete-category/{id}', [CategoryController::class, 'delete'])->name('delete-category');

    Route::get('/add-product', [ProductController::class, 'index'])->name('add-product');
    Route::post('/add-product', [ProductController::class, 'store'])->name('store-product');
    Route::get('/view-all-product', [ProductController::class, 'viewAll'])->name('view-all-product');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product');
    Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('update-product');
    Route::get('/delete-product/{id}', [ProductController::class, 'delete'])->name('delete-product');
    Route::post('/search-product', [ProductController::class, 'search'])->name('search-product');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/orders', [OrderController::class, 'view'])->name('orders');
    Route::get('/order/{id}', [OrderController::class, 'edit'])->name('order');
    Route::post('/order/{id}', [OrderController::class, 'update'])->name('update');
    Route::get('/search-order', [OrderController::class, 'search'])->name('search-order');
    Route::get('/download-invoice/{id}', [OrderController::class, 'invoice'])->name('invoice');
    Route::get('/invoiceview', [OrderController::class, 'invoiceview'])->name('invoiceview');
    Route::get('/invoice/download/{id}', [OrderController::class, 'downloadInvoice'])->name('invoice.download');

});



require __DIR__.'/auth.php';
