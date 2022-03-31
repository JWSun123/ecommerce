<?php

namespace App\Http\Controllers\Admin;

use App\Models\Description;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $description = Description::whereNotNull('description')->first();
        return view('admin.index', compact('description'));
    }
}
