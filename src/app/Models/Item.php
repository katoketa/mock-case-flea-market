<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'seller_id',
        'condition_id',
        'name',
        'price',
        'brand',
        'description',
        'image',
    ];
}
