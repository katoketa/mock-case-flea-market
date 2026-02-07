<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function mypage(Request $request)
    {
        $user = Auth::user();
        $page = $request->page;
        if (empty($page) || $page === "sell") {
            $items = $user->items;
            $items->load('purchase_history');
        } elseif ($page === "buy") {
            $purchase_histories = $user->purchase_histories;
            $purchase_histories->load('item');
            $items = [];
            foreach ($purchase_histories as $purchase_history) {
                $items[] = $purchase_history['item'];
            }
        }
        return view('mypage', compact('user', 'items', 'page'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('edit_profile', compact('user'));
    }

    public function update(Request $request)
    {
        // ここから続き
    }
}
