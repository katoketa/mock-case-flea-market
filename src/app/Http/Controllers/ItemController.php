<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        // Todo：自分が出品した商品は除外(ログインページ、新規会員登録ページ作成、認証ルーティング設定後に変更予定)
        $items = Item::with('purchase_history')->get();
        return view('index', compact('items'));
    }

    public function detail(Item $item)
    {
        return view('detail', ['item' => $item]);
    }
}
