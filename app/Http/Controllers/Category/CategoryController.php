<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoryController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user=User::find(Auth::id());
        if($user==null){
            return response('not authenticated',500);
        }else
        {
            if($user->id==Auth::user()->id){
                if(Auth::user()->role=='storeOwner'){
                    $category=Category::create([
                        'name'=>$request->name,
                        'description'=>$request->description,
                        'storeOwner_id'=>Auth::id()
                    ]);
                    return response()->json($category,201);
                }
                else 
                {
                    return response()->json('must signin as storeOwner',400);
                }
            }
        }
     
    }



    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
       $category=Category::find($id);
       if($category==null){
           return response()->json('no categories found',404);
       }
       else{
           if($category->storeOwner_id==Auth::id()){
            $category->name=$request->name;
            $category->description=$request->description;
            $category->save();
            return response()->json($category,200);
           }
           else{
               return response()->json('something went wrong',500);
           }
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $category=Category::find($id);
     if($category==null){
        return response()->json('no categories found',404);
    }
    else{
        if($category->storeOwner_id==Auth::id()){
        $deleted=$category->delete();
if($deleted==true){

    return response()->json(['deleted: ',$category],200);
}
}
        else{
            return response()->json('something went wrong',500);
        }
    }
}
}
