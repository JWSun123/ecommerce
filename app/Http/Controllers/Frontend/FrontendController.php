<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $products = Product::all()->take(10);
        return view('frontend.index', compact('products'));
    }

    public function category(){
        $categories = Category::all();
        return view('frontend.category', compact('categories'));
    }

    public function viewCategory($id){
        $products = Product::where('category_id', $id)->get();
        return view('frontend.products.index', compact('products'));
    }

    public function productView($id){
        $product = Product::where('id', $id)->first();
        return view('frontend.products.view', compact('product'));
    }
}
