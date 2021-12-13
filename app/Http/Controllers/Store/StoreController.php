<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\StoreOwner;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStores()
    {
        $stores= Store::select('*')->get();
        if($stores==null){
            return response()->json('no stores yet',200);
        }else{
            return response()->json($stores,200);

        }
    }

   
    public function create()
    {
    //    in store owner creation
    }

   

   
    public function getstore($id)
    {
        $store=Store::find($id);
        if($store==null){
            return response()->json('no stores found',404);
        }else{
        $user=User::find($store->store_owner_id);
        $response=collect($store)->merge([
            'user'=>$user
        ]); 
        return response()->json($response,200);
    }
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
        $store=Store::find($id);
        if($store==null){
            return response()->json('no store found',404);
        }
        else{
            $deleted=$store->delete();
            if($deleted==true){
                return response()->json('store have been deleted',200);
            }
            else{
                return response()->json('error occured',500);
            }
        }
    }
}
