<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Color;
use App\Models\Entry;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    public function index(){
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.attribute.index', compact('sizes','colors'));
    }

    public function addSize(Request $request){
        $size = new Size();
        $size->size = $request->input('size');
        $size->save();
        return redirect('attributes')->with('status',"Size Added Successfully");
    }

    public function addColor(Request $request){
        $color = new Color();
        $color->color = $request->input('color');
        $color->save();
        return redirect('attributes')->with('status',"Color Added Successfully");
    }

    public function deleteSize($id){
        $size = Size::find($id);
        if (count($size->entries) <= 0){
            $size->delete();
            return redirect('attributes')->with('status',"Size Deleted Successfully");
        }
        else{
            return redirect('attributes')->with('status',"Size cannot be deleted! Delete product entry first!");
        }
    }

    public function deleteColor($id){
        $color = Color::find($id);
        if (count($color->entries) <= 0){
            $color->delete();
            return redirect('attributes')->with('status',"Color Deleted Successfully");
        }
        else{
            return redirect('attributes')->with('status',"Color cannot be deleted! Delete product entry first!");
        }

    }

    public function viewEntry($id){
        $entries = Entry::where('product_id', $id)->get();
        $product_id = $id;
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.attribute.view', compact('entries','sizes','colors','product_id'));
    }

    public function addEntry(Request $request){
        $entry = new Entry();

        $product_id = $entry->product_id = $request->input('product_id');
        $dbProduct_id = Entry::find($product_id);

        $size_id = $entry->size_id = $request->input('size_id');
        $color_id = $entry->color_id = $request->input('color_id');
        $quantity = $entry->quantity = $request->input('quantity');
        if($dbProduct_id->color_id == $color_id && $dbProduct_id->size_id == $size_id && $dbProduct_id->quantity == $quantity){
            return redirect('view-entry/'.$entry->product_id)->with('status', "This entry already exist for {$dbProduct_id->size->size} and {$dbProduct_id->color->color}. Please modify the quantity.");
        } else if ($dbProduct_id->quantity != $quantity) {
            $dbProduct_id->quantity = $request->input('quantity');
            $dbProduct_id->save();
            return redirect('view-entry/'.$entry->product_id)->with('status', "The quantity has been modified for {$dbProduct_id->size->size} and {$dbProduct_id->color->color}.");
        }
        $entry->save();
        return redirect('view-entry/'.$entry->product_id)->with('status', "Product Entry Added Successfully!");
    }

    public function deleteEntry($id){
        $entry = Entry::find($id);
        $entry->delete();
        return redirect('view-entry/'.$entry->product_id)->with('status', "Product Entry Deleted Successfully!");
    }
}
