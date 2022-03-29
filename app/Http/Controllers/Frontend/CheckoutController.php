<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $old_cartItems = Cart::where('user_id', Auth::id())->get();
        foreach($old_cartItems as $item){
            if(!Product::where('id',$item->prod_id)->where('quantity', ">=", $item->prod_qty)->exists()){
                $removeItem = Cart::where('user_id', Auth::id())->where('prod_id',$item->prod_id)->first();
                $removeItem->delete();
            }
        }
        $cartItems = Cart::where('user_id', Auth::id())->get();

        $payments = Payment::where('user_id', Auth::id())->get();

        return view('frontend.checkout', compact('cartItems', 'payments'));
    }

    public function placeOrder(Request $request){
        if($request->input('storedpayment') == NULL){
            $payment = new Payment();
            $payment->user_id = Auth::id();
            $payment->payment_method = $request->input('method');
            $payment->user_name = $request->input('username');
            $payment->card_number = $request->input('cardnumber');
            $payment->expiry_date = $request->input('expirydate');
            $payment->cvv = $request->input('cvv');
            $payment->save();
        }
        else{
            $payment = Payment::find($request->input('storedpayment'));
        }


        $order = new Order();
        $order->user_id = Auth::id();
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->apartment = $request->input('apartment');
        $order->city = $request->input('city');
        $order->province = $request->input('province');
        $order->country = $request->input('country');
        $order->postalcode = $request->input('postalcode');
        $order->tracking_no = uniqid('QC');
        $order->payment_mode = $payment->payment_method;
        $order->payment_id = $payment->id;

        $total = 0;
        $cartItems_total = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems_total as $item)
        {
            $total += $item->products->price * $item->prod_qty;
        }
        $order->total_amount = $total;
        $order->save();


        $order->id;
        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems as $item){
            OrderItem::create([
                'order_id'=>$order->id,
                'prod_id'=>$item->prod_id,
                'price'=>$item->products->price,
                'quantity'=>$item->prod_qty,
            ]);
            $product = Product::where('id', $item->prod_id)->first();
            $product->quantity -= $item->prod_qty;
            $product->update();
        }
        if(Auth::user()->address == NULL){
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->apartment = $request->input('apartment');
            $user->city = $request->input('city');
            $user->province = $request->input('province');
            $user->country = $request->input('country');
            $user->postalcode = $request->input('postalcode');
            $user->update();
        }

        $cartItems = Cart::where ('user_id', Auth::id())->get();
        Cart::destroy($cartItems);
        return redirect('/')->with('status', 'Order Placed Successfully! Order No: '.$order->id);
    }

    public function showPayment(Request $request){
        $payment_id = $request->input('payment_id');
        $payment = Payment::where('id', $payment_id)->first();
        return response()->json([
            'payment_method'=>$payment->payment_method,
            'user_name'=>$payment->user_name,
            'card_number'=>$payment->card_number,
            'expiry_date'=>$payment->expiry_date,
            'cvv'=>$payment->cvv,
        ]);
    }

}
