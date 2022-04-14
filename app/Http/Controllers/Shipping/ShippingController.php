<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingFormRequest;
use App\Models\Shipping;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function createShipping(ShippingFormRequest $request){
        try{
            $user=User::find(Auth::id());
            $shipping=Shipping::create([
                'name'=>$user->name.' shipping',
                'description'=>$request->description,
                'shipping_address'=>$request->shipping_address,
                'shipping_method'=>$request->shipping_method,
                'city_id'=>$user->city_id,
                'user_id'=>$user->id,
                'cart_id'=>$user->cart->id,
                'cost'=>'12.58',//should be nullable
                'country_id'=>$user->country_id,
                        ]);
            // $shipping->with(['cart','user:id,name','country:id,name','city:id,name'])->get()
            return response()->json($shipping,201);

        }catch(Exception $error){
            return response()->json($error);
        }

    }


    
}
