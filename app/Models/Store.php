<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'address',
        'currency',
        'country',
        'city,',
        'about',
        'logo',
        'is_active',
        'store_theme',
        'theme_dir',
        'store_link',
        'facebook',
        'whatsapp',
        'instagram',
        'twitter',
    ];
}
