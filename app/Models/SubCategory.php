<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'catgeory_id'
    ];
    public function category(){
        return $this->belongsTo('App\Models\Category', 'id', 'category_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

}
