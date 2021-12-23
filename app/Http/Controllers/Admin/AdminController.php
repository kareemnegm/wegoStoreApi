<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginFormRequestAdmin;
use App\Models\Admin;
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


        response(['admin' => $admin, "token" => $token]);
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
}
