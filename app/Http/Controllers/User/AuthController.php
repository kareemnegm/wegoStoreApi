<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SignupFormRequest;
use App\Models\Customer;
use App\Models\StoreOwner;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function signup(SignupFormRequest $request)
    {
           
        $user = User::create(
            [   'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role'=>$request->role,
            ]);
            // $user->assignRole($request->role); 
                
            if($user->role=='storeOwner'){
              
                $storeOwner=StoreOwner::create([
                    'id'=>$user->id,
                         ]);
                         
              $token = JWTAuth::fromUser($user);
              $fullUser=User::find($user->id);
              $fullstoreOwner=StoreOwner::find($user->id);
              $responseData= collect($fullUser)->merge([
                'storeOwner' => $fullstoreOwner,
            ]);  
            // $user->sendEmailVerificationNotification();

              return $this->dataResponse(["user"=>$responseData,"token"=>$token]);
            }
            elseif($user->role=='customer')
            {
                if(!$request->city_id)
                {
                    return response()->json('must choose city',406); //unacceptable
                }
                
                $customer=Customer::create([
                    'id'=>$user->id,
                    'city_id'=>$request->city_id,
                ]);
                $user->customer = ["city_id" => $customer->city_id];
                $token = JWTAuth::fromUser($user);
              $fullUser=User::find($user->id);

                $responseData= collect($fullUser)->merge([
                    'customer' => $customer,
                ]);  
                return $this->dataResponse(["user"=>$responseData,"token"=>$token]);
            }
          
       
    }

    
    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
