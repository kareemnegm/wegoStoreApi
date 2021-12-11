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
        'theme_dir',
        'store_link',
        'facebook',
        'whatsapp',
        'instagram',
        'twitter',
    ];
    public function storeOwner(){
        return $this->belongsTo(StoreOwner::class);
    }

    public function country(){
        return $this->belongsTo('App\Models\Country','id','country_id');
    }
    
    public function city(){
        return $this->belongsTo('App\Models\City','id','City_id');
    }
}
