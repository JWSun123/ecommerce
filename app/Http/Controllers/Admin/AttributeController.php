<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Color;
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
        $size->delete();
        return redirect('attributes')->with('status',"Size Deleted Successfully");
    }

    public function deleteColor($id){
        $color = Color::find($id);
        $color->delete();
        return redirect('attributes')->with('status',"Color Deleted Successfully");
    }
}
