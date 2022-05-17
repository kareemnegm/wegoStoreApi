<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link_slug',
        'font',
        'image',
        'meta_tags',
        'meta_title',
        'meta_description',
        'meta_image',
        'name',
        'url'
    ];
}
