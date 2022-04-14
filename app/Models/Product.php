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
        'SKU',  // product code mohm  , //barcode
        'product_tax',   // taxed or  not
        'product_display', //thumbnail  sura r2sia
        'product_images', //---> many to many to be done
        'rating_display', // true ot false + rating
        'specification', //included
        'product_display',
        'rating_display',
        'description',
        'detail',
        'created_by',
        'store_id',
        'productExtraAttributes',
        'shipping_cost'
    ];
    public $timestamps = false;

    protected $casts = [
        'productExtraAttributes' => 'array',
        // 'message' => 'array',
    ];
public function store(){
    return $this->belongsTo(Store::class);
}
public function subcategory(){
    return $this->belongsToMany(SubCategory::class);
}



    public function cart(){
        return $this->belongsToMany(Cart::class,);
    }
    public function order(){
        return $this->belongsToMany(Product::class,);
    }
    public function coupons(){
        return $this->belongsToMany(Coupon::class,);
    }


    public function Images(){
        return $this->hasMany(Image::class);
    }
}
