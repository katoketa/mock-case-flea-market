<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // TODO：自分が出品した商品は除外するようにする（認証時、おすすめ表示)
        if (empty(Auth::user())) {
            if ($request->tab === "mylist") {
                $items = [];
            } else {
                $items = Item::with('purchase_history')->get();
            }
        }  else {
            if ($request->tab === "mylist") {
                $items = Auth::user()->favorites;
                $items->load('purchase_history');
            } else {
                $items = Item::with('purchase_history')->get();
            }
        }
        return view('index', ['items' => $items, 'tab' => $request->tab]);
    }

    public function detail(Item $item)
    {
        return view('detail', ['item' => $item]);
    }

    public function sell()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell', compact('categories', 'conditions'));
    }

    public function purchase(Item $item)
    {
        $user = Auth::user();
        $profile = $user['profile'];
        return view('purchase', compact('item', 'profile'));
    }
}
