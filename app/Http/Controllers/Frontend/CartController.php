<?php

namespace App\Http\Controllers\Frontend;

use id;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request){
        $prod_id = $request->input('product_id');
        $prod_qty = $request->input('product_qty');

        if(Auth::check()){
            $prod_check = Product::where('id', $prod_id)->first();
            if ($prod_check){
                if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()){
                    return response()->json(['status'=>$prod_check->name." Already in the Cart!"]);
                }
                else{
                    $cartItem = new Cart();
                    $cartItem->prod_id = $prod_id;
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
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()){
                $cartItem = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
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
}
