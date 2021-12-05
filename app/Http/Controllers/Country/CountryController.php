<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    

    // create country 
    public function storeCountry(Request $request)
    {
        $country=Country::create([
            'name'=>$request->country,
        ]);
        return response($country,201);
    }
// get countries
public function countries(){
    $country=Country::get();
    return response()->json($country,200);
}


//get countries with cities
public function countries_cities(){
    $country=Country::whereHas('city')->with('city')->select()->get();
    return response()->json($country,200);
}


// create city 
    public function storeCity(Request $request)
    {
        $city=City::create([
            'name'=>$request->name,
            'country_id'=>$request->country_id
        ]);
        return response($city,201);
    }


    //get cities from country
    public function cityFromCountry($id){
        $country=Country::find($id);
        if($country==null){
            return response()->json('wrong country id passed',404);
        }
        else
        {
            $cities=$country->city;
            return response()->json($cities,200);
        }
    }

}
