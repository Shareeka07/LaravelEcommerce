<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;

use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'home']);

Route::get('/dashboard',[HomeController::class,'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard',[HomeController::class,'index'])->middleware(['auth','admin']);
Route::get('/view_category',[AdminController::class,'view_category'])->middleware(['auth','admin'])->name('view_category');
Route::post('/add_category',[AdminController::class,'add_category'])->middleware(['auth','admin']);
Route::get('/edit_category/{id}',[AdminController::class,'edit_category'])->middleware(['auth','admin']);
Route::post('/update_category/{id}',[AdminController::class,'update_category'])->middleware(['auth','admin']);
Route::delete('/delete_category/{id}',[AdminController::class,'delete_category'])->middleware(['auth','admin'])->name('delete_category');


//product
Route::get('/add_product',[AdminController::class,'add_product'])->middleware(['auth','admin']);
Route::post('/save_product',[AdminController::class,'save_product'])->middleware(['auth','admin']);
Route::get('/view_product',[AdminController::class,'view_product'])->middleware(['auth','admin'])->name('view_product');
Route::get('/edit_product/{id}',[AdminController::class,'edit_product'])->middleware(['auth','admin']);
Route::post('/update_product/{id}',[AdminController::class,'update_product'])->middleware(['auth','admin']);
Route::delete('/delete_product/{id}',[AdminController::class,'delete_product'])->middleware(['auth','admin']);
Route::get('/product_details/{id}',[HomeController::class,'product_details']);

//cart
Route::get('/add_cart/{id}',[HomeController::class,'add_cart'])->middleware(['auth', 'verified']);
Route::get('/view_cart',[HomeController::class,'view_cart'])->middleware(['auth', 'verified']);
Route::delete('/remove_from_cart/{id}',[HomeController::class,'remove_from_cart'])->middleware(['auth','verified']);

//order_placement
Route::post('/place_order',[HomeController::class,'place_order'])->middleware(['auth', 'verified']);
Route::get('/view_orders',[AdminController::class,'view_orders'])->middleware(['auth','admin'])->name('view_orders');
Route::get('/on_the_way/{id}',[AdminController::class,'on_the_way'])->middleware(['auth','admin']);
Route::get('/delivered/{id}',[AdminController::class,'delivered'])->middleware(['auth','admin']);
Route::get('/print_pdf/{id}',[AdminController::class,'print_pdf'])->middleware(['auth','admin']);



Route::get('/payments',function(){
     return view('payment');
});
Route::post('/razorpay',[PaymentController::class,'razorpay'])->name('razorpay');
Route::get('/success',[PaymentController::class,'success'])->name('success');
Route::get('/cancel',[PaymentController::class,'cancel'])->name('cancel');







