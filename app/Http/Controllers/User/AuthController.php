<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SignupFormRequest;
use App\Models\Customer;
use App\Models\StoreOwner;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginFormRequest;
use App\Models\Cart;
use App\Models\Plan;
use App\Models\Store;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function signup(SignupFormRequest $request)
    {
        try {
            $user = User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role' => $request->role,
                    'city_id' => $request->city,
                    'country_id' => $request->country

                ]
            );

            // $user->assignRole($request->role);

            if ($user->role == 'storeOwner') {
                $store = Store::create([
                    'name' => $request->storeName,
                    'address' => $request->storeAddress,
                    'currency' => $request->currency,
                    'country_id' => $request->country,
                    'city_id' => $request->city,
                    'about' => $request->about,
                    'store_owner_id' => $user->id,
                    'plan_id' => $request->plan_id
                ]);


                $token = JWTAuth::fromUser($user);
                $fullUser = User::find($user->id);

                $responseData = collect($fullUser)->merge([
                    'store' => $store,
                ]);
                // $user->sendEmailVerificationNotification();
                return $this->dataResponse(["user" => $responseData, "token" => $token]);
            } elseif ($user->role == 'customer') {
                if (!$request->city) {
                    return response()->json('must choose city', 406); //unacceptable
                }

                $customer = Customer::create([
                    'phone_number' => $request->phone_number,
                    'street_name' => $request->street_name,
                    'building_number' => $request->building_number,
                    'flat_number' => $request->flat_number,
                    'address_notes' => $request->address_notes,
                    'id' => $user->id,
                    'city_id' => $request->city,
                ]);
                $user->customer = ["city_id" => $customer->city_id];
                $token = JWTAuth::fromUser($user);
                $fullUser = User::find($user->id);
                $cart = Cart::create(['name' => 'my cart', 'user_id' => $user->id]);
                $responseData = collect($fullUser)->merge([
                    'customer' => $customer,
                ]);
                return $this->dataResponse(["user" => $responseData, "token" => $token]);
            }
        } catch (Exception $e) {
            $user->delete();
            return response()->json($e->getMessage());
        }
    }


    public function login(LoginFormRequest $request)
    {

        $credentials = $request->only('email', 'password');
        if ($token = Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();

            if ($user->role == 'storeOwner') {


                return $this->dataResponse(["user" => $user, "token" => $token]);
            } elseif ($user->role == 'customer') {
                $Customer = Customer::find($user->id);
                $responseDataCustomer = collect($user)->merge([
                    'Customer' => $Customer,
                ]);
                return $this->dataResponse(["user" => $responseDataCustomer, "token" => $token]);
            }
        }
        if (!$token) {
            return $this->errorResponse('wrong Email Or password', 500);
        }
    }
}
