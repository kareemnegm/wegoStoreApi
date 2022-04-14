<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequestHandler;
use App\Models\Coupon;
use App\Models\CouponForTotalOrder;
use Exception;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function CreateCoupon(CouponRequestHandler $request)
    {
        try {
            $newCoupon = new Coupon();
            $newCoupon->code = $request->code;
            $newCoupon->type = $request->type;
            $newCoupon->startDate = $request->startDate;
            $newCoupon->endDate = $request->endDate;
            $newCoupon->discount_type = $request->discount_type;
            $newCoupon->discount = $request->discount;
            $newCoupon->save();
            if ($request->type == 'totalOrder') {
                $couponForTotalOrder = CouponForTotalOrder::create([
                    'minimum_shopping' => $request->minimum_shopping,
                    'maximum_discount_amount' => $request->maximum_discount_amount,
                    'coupon_id' => $newCoupon->id
                ]);
            } elseif ($request->type == 'product') {
                $productArray = [];
                $products = json_decode($request->products, true);
                foreach ($products as $product) {
                    $productArray[] = $product;
                }
                $newCoupon->product()->attach($productArray);
            }
            return response()->json($newCoupon,201);
        } catch (Exception $err) {
            return response()->json($err);
        }
    }


    
}
