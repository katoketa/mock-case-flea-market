<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $fillable = [
        'name',
    ];

    public function items()
    {
        $this->hasMany(Item::class);
    }
}
