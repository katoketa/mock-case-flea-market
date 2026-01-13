<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'item_id',
        'user_id',
        'comment',
    ];

    public function item()
    {
        $this->belongsTo(Item::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
