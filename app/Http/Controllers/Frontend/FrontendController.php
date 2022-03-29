<?php

namespace App\Http\Controllers\frontend;

use App\Models\Size;
use App\Models\Entry;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $entries = Entry::where('product_id', $id)->get();

        return view('frontend.products.view', compact('product','entries'));
    }
    public function selectSize(Request $request){
        $entry_id = $request->input('entry_id');
        $entry = Entry::find($entry_id);
        return response()->json([
            'color_id'=>$entry->color_id,
            'color'=>$entry->color->color,
        ]);
    }
}
