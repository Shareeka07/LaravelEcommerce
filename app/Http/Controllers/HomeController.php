<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;



class HomeController extends Controller
{
   public function index()
   {
    return view('admin.index');
   }
   public function home()
   {
    $products=DB::table('products')->where('IsDelete',0)->get();
    if(Auth::id())
    {
       $user=Auth::user();
       $count=DB::table('carts')->where('user_id',$user->id)->where('IsDelete',0)->count();
    }
    else{
      $count='';
    }
    return view('home.index',compact('products','count'));
   }
   public function login_home()
   {

    $products=DB::table('products')->where('IsDelete',0)->get();
    if(Auth::id())
    {
       $user=Auth::user();
       $count=DB::table('carts')->where('user_id',$user->id)->where('IsDelete',0)->count();
    }
    else{
      $count='';
    }
    return view('home.index',compact('products','count'));
   }
   public function product_details($id)
   {
       $products=DB::table('products')->where('id',$id)->where('IsDelete',0)->first();
       if(Auth::id())
       {
          $user=Auth::user();
          $count=DB::table('carts')->where('user_id',$user->id)->where('IsDelete',0)->count();
       }
       else{
         $count='';
       }
       return view('home.product_details',compact('products','count'));
       
   }
   public function add_cart($id){
     
      $user = Auth::user(); 
      if($user){
      $product=DB::table('products')->where('id',$id)->first();
      if($product)
      {
       DB::table('carts')->insert([
         'user_id'=>$user->id,
         'product_id'=>$product->id,
       ]);
       return redirect()->route('dashboard')->with('success', 'Product added to cart successfully!');
      }
      return redirect()->route('dashboard')->with('error', 'Product not found');
   }
   }
   public function view_cart()
   {   
      $user=Auth::user();
      if($user)
      {
         $count=DB::table('carts')->where('user_id',$user->id)->where('IsDelete',0)->count();
      }
      else{
        $count='';
      }
      // $carts = Cart::where('user_id', $user->id)->get(); using eloquent orm

      $carts = DB::table('carts')
    ->join('products', 'products.id', '=', 'carts.product_id')
    ->select(
        'carts.id as cart_id',  // Aliasing to avoid conflicts
        'carts.user_id',
        'carts.product_id',
        'carts.IsActive',
        'carts.IsDelete',
        'products.id as product_id', // Aliasing product id
        'products.title',     // Specify necessary product columns
        'products.price',
         'products.image'
    )
    ->where('carts.user_id', $user->id)
    ->where('carts.IsDelete', 0)
    ->get();
     return view('home.view_cart',compact('count','carts'));
   }
  

   public function remove_from_cart($id)
   {
      
   
       if (!$id) {
           return redirect()->back()->with('error', 'Cart ID is required');
       }
   
       // Check if the product exists before attempting to delete
       $cartItem = DB::table('carts')->where('id', $id)->first();
       
       if (!$cartItem) {
        
           return redirect()->back()->with('error', 'Product not found.');
       }
   
      
   
       $deleted = DB::table('carts')->where('id', $id)->update(['IsDelete' => 1]);
   
     
   
       if ($deleted) {
           return redirect()->back()->with('success', 'Product deleted from cart successfully!');
       } else {
           return redirect()->back()->with('error', 'Product could not be marked as deleted.');
       }
   }

   public function place_order(Request $request)
   {   
      $user=Auth::user();
      $carts=DB::table('carts')->where('user_id',$user->id)->where('IsDelete',0)->get();
      if ($carts->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }
      foreach($carts as $cart){
      DB::table('orders')->insert([
        'name'=>$request->name,
        'order_phone'=>$request->phone,
        'order_address'=>$request->address,
        'user_id'=>$user->id,
        'product_id'=>$cart->product_id,
      ]);
      DB::table('carts')->where('id',$cart->id)->update([
        'IsDelete'=>1
      ]);
    }

   return redirect()->back()->with('success','Order placed Successfully!');

   }
   
}
