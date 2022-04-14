<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponForTotalOrder extends Model
{
    use HasFactory;
    protected $fillable=[
        'minimum_shopping',
        'maximum_discount_amount',
        'coupon_id'
    ];

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
}
