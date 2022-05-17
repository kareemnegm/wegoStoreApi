<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Shipping extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'shipping_address',
        "cost",
        "shipping_method",
        "country_id",
        "city_id",
        "user_id",
        "order_id",// de holds all of the products details
    ];


public function city(){
    return $this->belongsTo(City::class);
}
public function country(){
    return $this->belongsTo(Country::class);
}
public function user(){
    return $this->belongsTo(User::class);
}
public function cart(){
    return $this->belongsTo(Cart::class);
}



}
