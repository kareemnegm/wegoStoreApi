<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=[
        'id',
        'city_id',
        'phone_number',
        'street_name',
        'building_number',
        'flat_number',
        'address_notes' //optional
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

 //    customer has 1 city
 public function city()
 {
     return $this->belongsTo(City::class);
 }
 public function getJWTIdentifier()
{
    return $this->getKey();
}

/**
 * Return a key value array, containing any custom claims to be added to the JWT.
 *
 * @return array
 */
public function getJWTCustomClaims()
{
    return [];
}
}
