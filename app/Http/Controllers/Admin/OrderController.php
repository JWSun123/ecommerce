<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function editOrder($id){
        $order = Order::where('id', $id)->first();
        return view('admin.orders.edit', compact('order'));
    }

    public function updateOrder(Request $request, $id){
        $order = Order::find($id);
        $order->status = $request->input('status');
        $order->update();
        return redirect('orders')->with('status', "Order Status Updated Successfully!");
    }
}
