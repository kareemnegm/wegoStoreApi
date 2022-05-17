<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'address',
        'currency',
        'country_id',
        'city_id',
        'about',
        'logo',
        'is_active',
        'store_theme',
        'theme_dir', //theme dir id to be handled with the front end developer 
        'store_link',
        'facebook',
        'whatsapp',
        'instagram',
        'twitter',
        'store_owner_id',
        'plan_id',

    ];
    public function product(){
        return $this->hasMany(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function country(){
        return $this->belongsTo('App\Models\Country','id','country_id');
    }

    public function city(){
        return $this->belongsTo('App\Models\City','id','City_id');
    }

    public function plan(){
        return $this->belongsTo('App\Models\Plan','id','plan_id');
    }
}
