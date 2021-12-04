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
        'user_address_id',
        'product_id',
        'shipping_data',
        'price',
        'cupon',
        'net_price_discount',
        'status',
        
    ];
}
