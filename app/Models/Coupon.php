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
        'store_owner_id',// foreign key nullable to be made in migrations 

    ];

    public function couponForTotalOrders()
    {
        return $this->has(CouponForTotalOrder::class);
    }
    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }


}
