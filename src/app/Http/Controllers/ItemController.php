<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            if ($request->tab === "mylist") {
                $items = $user->favorites()->KeywordSearch($request->keyword)->get();
            } else {
                $items = Item::with('purchase_history')->where('seller_id', '<>', $user->id)->KeywordSearch($request->keyword)->get();
            }
        } else {
            if ($request->tab === "mylist") {
                $items = [];
            } else {
                $items = Item::with('purchase_history')->KeywordSearch($request->keyword)->get();
            }
        }
        return view('index', ['items' => $items, 'tab' => $request->tab, 'keyword' => $request->keyword]);
    }

    public function detail(Item $item)
    {
        $user = Auth::user();
        if ($user) {
            $favorites = $user->favorites;
        } else {
            $favorites = null;
        }
        $item->load('comments.user.profile');
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

    public function create(ExhibitionRequest $request)
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
        $user = Auth::user();
        $destinationAddress = [
            'postal_code' => $user['profile']['postal_code'],
            'address' => $user['profile']['address'],
            'building' => $user['profile']['building'],
        ];
        return view('purchase', compact('item', 'user', 'destinationAddress'));
    }

    public function editAddress(Item $item)
    {
        return view('change_address', compact('item'));
    }

    public function updateAddress(AddressRequest $request, Item $item)
    {
        $user = Auth::user();
        $destinationAddress = $request->only('postal_code', 'address', 'building');
        return view('purchase', compact('item', 'user', 'destinationAddress'));
    }
}
