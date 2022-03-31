<?php

namespace App\Http\Controllers\Admin;

use App\Models\Description;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DescriptionController extends Controller
{
    public function about(Request $request){
        $description = Description::whereNotNull('description')->first();
        if ($description === null) {
            $description = new Description();
            $description->description = $request->input('description');
            $description->save();
            return view('admin.index', compact('description'));
        }
        $description->description = $request->input('description');
        $description->save();
        return view('admin.index', compact('description'));
    }

    public function show(){
        $description = Description::whereNotNull('description')->first();
        return view('frontend.about', compact('description'));
    }
}
