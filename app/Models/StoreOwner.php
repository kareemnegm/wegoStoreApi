<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOwner extends Model
{
    use HasFactory;
    protected $fillable=[
        'id', //user_id
        'store_id',
        'is_active',  
    ];
    //store owner belongs to user 
public function user(){
    return $this->belongsTo(User::class);
}


public function store(){
    return $this->hasOne('App\Models\Store', 'id', 'store_id');
}

}
