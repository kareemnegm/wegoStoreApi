<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'price',
        'duration',
        'maximum_product_per_store',
        'image'
    ];

    public function store(){
        return $this->hasMany(Store::class);
    }
}
