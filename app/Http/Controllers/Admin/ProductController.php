<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }
    public function add(){
        $category = Category::all();
        return view('admin.product.add', compact('category'));
    }

    public function insert(Request $request){
        $product = new Product();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/products/',$filename);
            $product->image = $filename;
        }
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->brand = $request->input('brand');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->status = $request->input('status') == TRUE ? '1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->meta_descrip = $request->input('meta_descrip');
        $product->save();
        return redirect('products')->with('status', "Product Added Successfully!");
    }

    public function edit($id){
        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        if($request->hasFile('image')){
            $path = 'assets/uploads/products/'.$product->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/products/',$filename);
            $product->image = $filename;
        }
        $product->name = $request->input('name');
        $product->brand = $request->input('brand');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->status = $request->input('status') == TRUE ? '1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->meta_descrip = $request->input('meta_descrip');
        $product->save();
        return redirect('products')->with('status', "Product Updated Successfully!");
    }

    public function delete($id){
        $product = Product::find($id);
        if($product->image){
            $path = 'assets/uploads/products/'.$product->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $product->delete();
        return redirect('products')->with('status',"Product Deleted Successfully");
    }
}
