<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function addProductToCart(Request $request)
    {
        try {
        $user=User::find(Auth::id());
        if($user->role=='customer'){
            $cart=Cart::find($user->cart->id);
            if($cart==null)$cart=Cart::create(['name'=>'my cart','user_id'=>Auth::id()]);
            $cart->product()->syncWithoutDetaching($request->products);
            return response()->json($cart->product,201);
        }
        } catch (Exception $error) {
            return response()->json($error);
        }
    }

    public function getMyCart()
    {
        try {
            $user=User::find(Auth::id());
            if($user->role=='customer'){
                $cart=Cart::find($user->cart->id);
                if($cart==null)return response()->json('you have not added any product to the cart yet',200);
                return response()->json($cart->with('product')->get(),200);
            }
            } catch (Exception $error) {
                return response()->json($error);
            }
    }

  
}
