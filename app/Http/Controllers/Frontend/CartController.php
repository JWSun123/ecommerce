<?php

namespace App\Http\Controllers\Frontend;

use id;
use App\Models\Cart;
use App\Models\Entry;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request){
        $entry_id = $request->input('entry_id');
        $prod_qty = $request->input('product_qty');

        if(Auth::check()){
            $prod_check = Entry::where('id', $entry_id)->first();
            if ($prod_check){
                if(Cart::where('entry_id', $entry_id)->where('user_id', Auth::id())->exists()){
                    return response()->json(['status'=>$prod_check->name." Already in the Cart!"]);
                }
                else{
                    $cartItem = new Cart();
                    $cartItem->entry_id = $entry_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->prod_qty = $prod_qty;
                    $cartItem->save();
                    return response()->json(['status'=>$prod_check->name." Added to Cart!"]);
                }

            }
        }
        else{
            return response()->json(['status'=>'Login to Continue']);
        }
    }

    public function viewCart(){
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart', compact('cartItems'));
    }

    public function deleteProduct(Request $request){
        if (Auth::check()){
            $entry_id = $request->input('entry_id');
            if(Cart::where('entry_id', $entry_id)->where('user_id', Auth::id())->exists()){
                $cartItem = Cart::where('entry_id', $entry_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Item Deleted Successfully"]);
            }
        }
        else{
            return response()->json(['status'=>'Login to Continue']);
        }
    }
    public function cartcount(){
        $cartcount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count'=> $cartcount]);
    }

    public function updateCart(Request $request){
        $entry_id = $request->input('entry_id');
        $prod_qty = $request->input('prod_qty');
        if(Auth::check()){
            if(Cart::where('entry_id', $entry_id)->where('user_id', Auth::id())->exists()){
                $cartItem = Cart::where('entry_id', $entry_id)->where('user_id', Auth::id())->first();
                $cartItem->prod_qty = $prod_qty;
                $cartItem->update();
                return response()->json(['status' => "Cart Updated Successfully"]);
            }
        }
        else{
            return response()->json(['status'=>'Login to Continue']);
        }
    }
}
