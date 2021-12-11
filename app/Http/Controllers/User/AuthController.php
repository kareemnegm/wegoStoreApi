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
use App\Models\Store;
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
           
        $user = User::create(
            [   'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role'=>$request->role,
                'city_id'=>$request->city,
                'country_id'=>$request->country

            ]);
      
            // $user->assignRole($request->role); 
                
            if($user->role=='storeOwner'){
                $store=Store::create([
                    'name'=>$request->storeName,
                    'address'=>$request->storeAddress,
                    'currency'=>$request->currency,
                    'country_id'=>$request->country,
                    'city_id'=>$request->city,
                    'about'=>$request->about,
                    'logo'=>$request->logo,
                    'is_active'=>$request->is_active,
                    'store_theme'=>$request->store_theme,
                    'theme_dir'=>$request->theme_dir,
                    'store_link'=>$request->store_link,
                    'facebook'=>$request->facebook,
                    'whatsapp'=>$request->whatsapp,
                    'instagram'=>$request->instagram,
                    'twitter'=>$request->twitter,
                    
                ]); 
                $storeOwner=StoreOwner::create([
                    'id'=>$user->id,
                    'store_id'=>$store->id
                         ]);
                      

              $token = JWTAuth::fromUser($user);
              $fullUser=User::find($user->id);
              $storeOwner=StoreOwner::find($user->id);
              $fullstoreOwner=$storeOwner->store()->get();
              $responseData= collect($fullUser)->merge([
                'storeOwner' => $fullstoreOwner,
            ]);  
            // $user->sendEmailVerificationNotification();
              return $this->dataResponse(["user"=>$responseData,"token"=>$token]);
            }
            elseif($user->role=='customer')
            {
                if(!$request->city)
                {
                    return response()->json('must choose city',406); //unacceptable
                }
                
                $customer=Customer::create([
                    'id'=>$user->id,
                    'city_id'=>$request->city,
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

    
    public function login(LoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if($token=Auth::guard('api')->attempt($credentials))
        {
            $user=Auth::guard('api')->user();

        
        
            if($user->role=='storeOwner'){
                $StoreOwner=StoreOwner::find($user->id);
                
                $responseData= collect($user)->merge([
                    'StoreOwner' => $StoreOwner,
                ]);  

                return $this->dataResponse(["user"=> $responseData,"token"=>$token]);
 
            }
            elseif($user->role=='customer'){
                $Customer=Customer::find($user->id);
                $responseDataCustomer= collect($user)->merge([
                    'Customer' => $Customer,
                ]);  
                return $this->dataResponse(["user"=> $responseDataCustomer,"token"=>$token]);

            }
        }
        if(!$token){
            return $this->errorResponse('wrong Email Or password',500);
        }

           

        
        }

   
}
