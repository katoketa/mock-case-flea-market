<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{
    protected $fillable = [
        'buyer_id',
        'item_id',
        'send_address',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function item()
    {
        $this->belongsTo(Item::class);
    }
}
