<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'type', //for product , for total orders
        'startDate',
        'endDate',
        'discount_type',
        'discount',

    ];

    public function couponForTotalOrders()
    {
        return $this->has(CouponForTotalOrder::class);
    }
    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
