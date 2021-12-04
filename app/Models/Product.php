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
        'product_tax',
        'product_display',
        'rating_display',
        'description',
        'detail',
        'specification',
        'created_by',
    ];
}
