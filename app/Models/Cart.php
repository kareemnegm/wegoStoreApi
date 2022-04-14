<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=[
        "name",
        "user_id"
    ];

    public function product(){
        return $this->belongsToMany(Product::class)->select(['product_id', 'name', 'price', 'product_display','shipping_cost'])->withPivot('quantity');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
