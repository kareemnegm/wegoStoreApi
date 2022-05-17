<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'country_id',
        'city_id'
    ];


    //user has  storeOwner

    public function store()
    {
        return $this->hasOne(Store::class, 'store_owner_id');
    }

    //user has  customer

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    // user belongs to country & city

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'id', 'country_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'id', 'City_id');
    }

    public function coupon()
    {
        return $this->hasOne(Coupon::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
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
        return [
            'id' => $this->id,
            'role' => $this->role
        ];
    }
}
