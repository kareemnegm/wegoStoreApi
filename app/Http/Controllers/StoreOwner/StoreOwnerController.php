<?php

namespace App\Http\Controllers\StoreOwner;

use App\Http\Controllers\Controller;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
