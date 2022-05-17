<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginFormRequestAdmin;
use App\Models\Admin;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function signupAdmin(Request $request)
    {
        $admin = Admin::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin'
        ]);
        // $admin->assignRole($admin->role);
        $token = JWTAuth::fromUser($admin);


        return response(['admin' => $admin, "token" => $token]);
    }

    public function login(loginFormRequestAdmin $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = Auth::guard('Admin')->attempt($credentials)) {
            $admin = Auth::guard('Admin')->user();


            if ($admin->role == 'admin') {
                return response()->json(['admin' => $admin, "token" => $token], 200);
            }
        }
        return response()->json('not authenticated ', 401);
    }





    public function createPlan(Request $request)
    {
        $admin=Admin::find(Auth::id());
        if($admin==null){
            return response()->json('not authorized',403);
        }
        else{
            $plan= Plan::create([
                'name'=>$request->name,
                'price'=>$request->price,
                'duration'=>$request->duration,
                'maximum_product_per_store'=>$request->maximum_product_per_store
            ]);
            return response()->json($plan,201);
        }

    }



    public function showPlans(){
        $admin=Admin::find(Auth::id());
        if($admin==null){
            return response()->json('not authorized',403);
        }else{
            $plans=Plan::get();
            return response()->json($plans,200);
        }

    }


    public function plan($id){
        $admin=Admin::find(Auth::id());
        if($admin==null){
            return response()->json('not authorized',403);
        }else{
            $plan=Plan::find($id);
            if($plan==null){
                return response()->json('no plans found',200);
            }else{
                return response()->json($plan,200);

            }
        }

    }



}
