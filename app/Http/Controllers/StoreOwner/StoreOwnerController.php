<?php

namespace App\Http\Controllers\StoreOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequestHandler;
use App\Models\Coupon;
use App\Models\CouponForTotalOrder;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreOwnerController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStoreProducts()
    {
        try {
            $user = User::find(Auth::id());
            if ($user->role == 'storeOwner') {
                $store = Store::where('store_owner_id', $user->id)->exists();
                if ($store == true) {
                    $store_id = Store::where('store_owner_id', $user->id)->value('id');
                    $products = Product::where('store_id', $store_id)->select()->get();
                    return response()->json($products, 200);
                }
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStoreProducts(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct($id)
    {
        try{
            $product=Product::find($id);
            if($product==null)return response()->json('no product found',500);
            $product->delete();
            return response()->json('product deleted successfully',200);

        }catch(Exception $err){
            return response()->json($err);

        }
    }


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
    public function showCoupons($id){
        $coupons=Coupon::where('');
    }
}
