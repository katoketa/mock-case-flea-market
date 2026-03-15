<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\PurchaseHistory;

class PurchaseHistoryController extends Controller
{
    public function payment(Request $request, Item $item)
    {
        $purchaseHistory = $request->only('postal_code', 'address', 'building');
        $purchaseHistory['item_id'] = $item['id'];
        $purchaseHistory['buyer_id'] = Auth::id();
        PurchaseHistory::create($purchaseHistory);

        return redirect('/');
    }
}