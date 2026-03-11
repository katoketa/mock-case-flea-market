<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create(Request $request, Item $item)
    {
        $create_comment = $request->only('user_id', 'item_id', 'comment');
        Comment::create($create_comment);
        return redirect('/item/' . $item['id']);
    }
}
