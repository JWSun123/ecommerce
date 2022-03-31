<?php

namespace App\Http\Controllers\frontend;

use App\Models\Size;
use App\Models\Entry;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $entries = Entry::where('product_id', $id)->get()->groupBy(function($data){
            return $data->size_id;
        });
        return view('frontend.products.view', compact('product','entries'));
    }
    public function selectSize(Request $request){
        $product_id = $request->input('product_id');
        $size_id = $request->input('size_id');

        $entries_color = DB::table('entries')
        ->select('product_id','size_id','color_id','quantity','color')
        ->join('colors','entries.color_id','=','colors.id')
        ->where('product_id', $product_id)->where('size_id', $size_id)
        ->get();

        //$entries = Entry::where('product_id', $product_id)->where('size_id', $size_id)->get();
        return response()->json([
            'entries_color'=>$entries_color
        ]);
    }

    public function getQuantity(Request $request){
        $product_id = $request->input('product_id');
        $size_id = $request->input('size_id');
        $color_id = $request->input('color_id');
        $entry = Entry::where('product_id', $product_id)->where('size_id', $size_id)->where('color_id', $color_id)->first();
        return response()->json([
            'entry'=>$entry
        ]);
    }
}
