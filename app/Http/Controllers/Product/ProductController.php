<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProduct(Request $request)
    {
        $user=User::find(Auth::id());
        if($user==null){
            return response()->json("wrong credentials",500);
        }
        else{
            if($user->role==Auth::user()->role){
                if($request->has('subcategory_id')){
                    $subcat=SubCategory::find($request->subcategory_id);
                    if($subcat==null){
                        return response()->json('no subcategory found',406);
                    }else{
                       $check=$subcat->category->storeOwner_id;
                      if($check==Auth::id()){
                        $product=Product::create([
                            'name'=>$request->name,
                            'price'=>$request->price,
                            'quantity'=>$request->quantity,
                            'product_display'=>$request->product_display,
                            'rating_display'=>$request->rating_display,
                            'description'=>$request->description,
                            'detail'=>$request->detail,
                            'created_by'=>Auth::id(),
                            // 'store_id'=>
                        ]);
                       $product->subcategory()->attach($request->subcategory_id);
                        return response()->json($product,201);
                      }else{
                          return response()->json('not authorized to add products to this subcategory its not users',401);
                      }
                    }
                   
                }
               
            }
            
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
