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
        $newSize = new Size();
        $size = $request->input('size');
        $count = Size::where('size', '=', $size)->count();
        if($count > 0) {
            return redirect('attributes')->with('status',"Size {$size} already exists");
        }
        $newSize->size = $size;
        $newSize->save();
        return redirect('attributes')->with('status',"Size Added Successfully");
    }

    public function addColor(Request $request){
        $newColor = new Color();
        $color = $request->input('color');
        $count = Color::where('color', '=', $color)->count();
        if($count > 0) {
            return redirect('attributes')->with('status',"Color {$color} already exists");
        }
        $newColor->color = $color;
        $newColor->save();
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
        $product_id = $request->input('product_id');
        $size_id = $request->input('size_id');
        $color_id = $request->input('color_id');
        $quantity = $request->input('quantity');

        $entry->product_id = $product_id;
        $entry->size_id = $size_id;
        $entry->color_id = $color_id;
        $entry->quantity = $quantity;

        $color = Color::find($color_id);
        $size = Size::find($size_id);

        $db = Entry::where('product_id', '=', $product_id);
        $whereEverything = ['product_id' => $product_id, 'size_id' => $size_id, 'color_id' => $color_id, 'quantity' => $quantity];
        $whereDiffQty = ['product_id' => $product_id, 'size_id' => $size_id, 'color_id' => $color_id];

        if ($db->get() !== null) {
            if (Entry::where($whereEverything)->count() > 0) {
                return redirect('view-entry/'.$product_id)->with('status', "This entry already exist for size {$size->size} and color {$color->color}. Please modify the quantity.");
            } else if (Entry::where($whereDiffQty)->count() > 0) {
                $entry_id = Entry::where($whereDiffQty)->value('id');
                $db = Entry::find($entry_id);
                $db->quantity = $quantity;
                $db->update();
                return redirect('view-entry/'.$product_id)->with('status', "The quantity has been modified for size {$size->size} and color {$color->color}.");
            }

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
