<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminController extends Controller
{
    public function view_category()
    {  
      $categories=DB::table('categories')->where('IsDelete',0)->get();
      return view('admin.view_category',compact('categories'));
    }
    public function add_category(Request $request)
    {
        $request->validate([
            'category'=>'required'
        ]);
        DB::table('categories')->insert([
            'category_name'=>$request->category
        ]);
        return redirect()->back()->with('success','Category added successfully!');

    }
    public function edit_category($id)
    {
       if(!$id)
       {
         return redirect()->back()->with('error', 'Category ID is required');
       }
        $category=DB::table('categories')->where('id',$id)->first();
         if(!$category)
         {
            return redirect()->back()->with('error','Category Not found');
         }
        return view('admin.edit_category',compact('category'));
    }
    public function update_category(Request $request)
    {
        $request->validate([
            'category'=>'required'
        ]);
        DB::table('categories')->where('id',$request->id)->update([
            'category_name'=>$request->category
        ]);
        return redirect()->route('view_category')->with('success','Category updated successfully!');
    }
    public function delete_category($id)
    {
        if(!$id)
       {
         return redirect()->back()->with('error', 'Category ID is required');
       }
       $deleted= DB::table('categories')->where('id',$id)->update([
        'IsDelete'=> 1
    
    ]);
    if($deleted)
    {
        return redirect()->route('view_category')->with('success','Category deleted successfully!');
    }
    else {
        return redirect()->back()->with('error', 'Category not found or could not be marked as deleted.');
    }
    }

    //product
    public function add_product()
    {
       $categories=DB::table('categories')->where('IsDelete',0)->get();
       return view('admin.add_product',compact('categories'));

    }

    public function save_product(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'price'=>'required',
            'image'=>'required',
            'category'=>'required',
            'quantity'=>'required',

        ]);
        $imagePath=null;
        if($request->hasFile('image')){
          $image=$request->image;
          $imageName=time().'.'.$image->getClientOriginalExtension();
          $imagePath = $image->storeAs('images', $imageName, 'public');
        }
        DB::table('products')->insert([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'image'=>$imagePath,
            'category_id'=>$request->category,
            'quantity'=>$request->quantity,

        ]);

        return redirect()->route('view_product')->with('success','Product added successfully!');

    }
    public function view_product(Request $request)
    {  

        $filter=$request->filterName;
      $query=DB::table('products')->join('categories','categories.id','=','products.category_id')->where('products.IsDelete',0)->select('products.*', 'categories.id as category_id', 'categories.category_name');
       if($filter){
        $query->where('products.title','like','%'.$filter.'%');
       }
       $products=$query->paginate(3);
      return view('admin.view_product',compact('products'));
    }
    public function edit_product($id)
    {
       if(!$id)
       {
         return redirect()->back()->with('error', 'Product ID is required');
       }
        $product=DB::table('products')->where('id',$id)->first();
        $categories = DB::table('categories')->where('IsDelete',0)->get();
     
         if(!$product)
         {
            return redirect()->back()->with('error','Product Not found');
         }
        return view('admin.edit_product',compact('product','categories'));
    }
    public function update_product(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'price'=>'required',
            'category'=>'required',
            'quantity'=>'required',

        ]);
        DB::table('products')->where('id',$request->id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'category_id'=>$request->category,
            'quantity'=>$request->quantity,

        ]);
        $imagePath=null;
        if($request->hasFile('update_image')){
          $image=$request->update_image;
          $imageName=time().'.'.$image->getClientOriginalExtension();
          $imagePath = $image->storeAs('images', $imageName, 'public');
           DB::table('products')->where('id',$request->id)->update([
            'image'=>$imagePath,
           ]);
        }
       
        return redirect()->route('view_product')->with('success','Product updated successfully!');
    }

    public function delete_product($id)
    {   
        $product=DB::table('products')->where('id',$id)->first();
        if(!$id)
       {
         return redirect()->back()->with('error', 'Product ID is required');
       }
       $deleted= DB::table('products')->where('id',$id)->update([
        'IsDelete'=> 1
    
    ]);
    $image_path=public_path('storage/'.$product->image);
    if(file_exists($image_path))
    {
        unlink($image_path);
    }
    if($deleted)
    {
        return redirect()->route('view_product')->with('success','Product deleted successfully!');
    }
    else {
        return redirect()->back()->with('error', 'Product not found or could not be marked as deleted.');
    }
    }
   public function view_orders(Request $request)
   {
     $filterName=$request->filterName;
    $query=DB::table('orders')->join('products','products.id','=','orders.product_id')->select('orders.*','products.title','products.image','products.price')->where('orders.IsDelete',0);
    if($filterName){
        $query->where('name','like','%'.$filterName.'%');
    }
    $orders=$query->paginate(2);
    return view('admin.view_orders',compact('orders'));
   }
   public function on_the_way($id){
      if(!$id){
        return redirect()->back()->with('errors','Order ID is required');
      }
      DB::table('orders')->where('id',$id)->where('IsDelete',0)->update([
        'order_status'=>'on the way'
      ]);
      return redirect()->back()->with('success','Order status succesfully!');
   }
   public function delivered($id){
    if(!$id){
      return redirect()->back()->with('errors','Order ID is required');
    }
    DB::table('orders')->where('id',$id)->where('IsDelete',0)->update([
      'order_status'=>'delivered'
    ]);
    return redirect()->back()->with('success','Order status succesfully!');

 }
    public function print_pdf($id)
    {   
        $data=DB::table('orders')->join('products','products.id','=','orders.product_id')->select('orders.*','products.title','products.price','products.image')->where('orders.id',$id)->first();
        $pdf = Pdf::loadView('admin.invoice',compact('data'));
        return $pdf->download('invoice.pdf');
    }

}
