<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
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
        'store_id'
    ];
    public $timestamps = false;

public function store(){
    return $this->belongsTo(Store::class);
}
public function subcategory(){
    return $this->belongsToMany(SubCategory::class);
}




    public function order(){
        return $this->belongsToMany(Product::class,);
    }
}
