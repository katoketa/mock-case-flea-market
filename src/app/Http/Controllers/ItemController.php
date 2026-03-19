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
        $user = Auth::user();
        if ($user) {
            $favorites = $user->favorites;
        } else {
            $favorites = null;
        }
        return view('detail', compact('item', 'user', 'favorites'));
    }

    public function createFavorite(Item $item)
    {
        $user = Auth::user();
        if (!$user) {
            return;
        }
        $item->favorites()->attach($user['id']);
        return redirect('item/' . $item['id']);
    }
    
    public function destroyFavorite(Item $item)
    {
        $user = Auth::user();
        if (!$user) {
            return;
        }
        $item->favorites()->detach($user['id']);
        return redirect('item/' . $item['id']);
    }
    
    public function sell()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell', compact('categories', 'conditions'));
    }

    public function create(Request $request)
    {
        $createItem = $request->only('condition_id', 'name', 'brand', 'description', 'price');
        $createItem['seller_id'] = Auth::id();

        $fileName = $request->file('image')->store('items', 'public');
        $createItem['image'] = 'storage/' . $fileName;

        $item = Item::create($createItem);
        $categories = $request->categories;
        $item->categories()->attach($categories);

        return redirect('/');
    }
    
    public function purchase(Item $item)
    {
        $profile = Auth::user()->profile;
        return view('purchase', compact('item', 'profile'));
    }

    public function editAddress(Item $item)
    {
        return view('change_address', compact('item'));
    }

    public function updateAddress(Request $request, Item $item)
    {
        $profile = Auth::user()->profile;
        $destinationAddress = $request->only('postal_code', 'address', 'building');
        return view('purchase', compact('item', 'profile', 'destinationAddress'));
    }

}
