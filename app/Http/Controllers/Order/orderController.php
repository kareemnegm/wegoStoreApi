<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardVerificationRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function createOrder(CardVerificationRequest $request)
    {
        $productArray=[];
        $user=User::find(Auth::id());
        if($user==null){
            return response('not authenticated',500);
        }
        else{
            if($user->id==Auth::user()->id){
                $validatedData = $request->validated();

                $order=Order::create([
                    'name'=>$request->name,
                    'email'=>Auth::user()->email,
                    'card_number'=>$validatedData['card_number'],
                    'card_exp_month'=>$validatedData['card_exp_month'],
                    'card_exp_year'=>$validatedData['card_exp_year'],
                    'card_exp_day'=>$request->day,
                    'price'=>$request->price,
                    'coupon'=>$request->coupon,
                    'net_price_discount'=>$request->price,
                    'status'=>0
                ]);
                $products=json_decode($request->products,true);

                foreach($products as $product){
                $productArray[]=$product;
                }
                $order->product()->attach($productArray);
                return response()->json($order,201);
            }
        }

    }
}
