<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'card_number',
        'card_exp_day',
        'card_exp_month',
        'card_exp_year',
        'shipping_data',
        'price',
        'coupon',
        'net_price_discount',
        'status',

    ];
    //order has many to  many  product
    // pivot table
public function product(){
    return $this->belongsToMany(Product::class,);

}

}
