<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'store_owner_id'
    ];
    public function storeOwner(){
        return $this->belongsTo('App\Models\StoreOwner', 'id', 'store_owner_id');
    } 
    
    public function subcategory(){
        return $this->hasMany(SubCategory::class);
    }
}
