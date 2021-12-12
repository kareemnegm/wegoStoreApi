<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'price',
        'quantity',
        'product_display',
        'rating_display',
        'description',
        'detail',
        'created_by',
    ];

public function subcategory(){
    return $this->belongsToMany(SubCategory::class);
}


}
