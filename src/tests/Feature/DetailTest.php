<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;
    /**
     * A basic feature test example.
     */
    public function testDetail(): void
    {
        // 必要な情報が表示される
        $selectItem = 9;
        $item = Item::find($selectItem);
        $response = $this->get('/item/' . $selectItem);
        $response->assertStatus(200);
        $response->assertSee($item['image']);       // 商品画像の確認
        $response->assertSee($item['name']);        // 商品名の確認
        $response->assertSee($item['brand']);       // ブランド名の確認
        $response->assertSee($item['price']);       // 価格の確認
        $response->assertSee($item['favorites']->count());      // いいね数の確認
        $response->assertSee($item['comments']->count());       // コメント数の確認
        $response->assertSee($item['description']);             // 商品説明の確認
        $response->assertSee($item['condition']['name']);       // 商品の状態の確認
        $response->assertSee('コメント(' . $item['comments']->count() . ')');       // コメント数の確認
        foreach ($item['comments'] as $comment) {
            $response->assertSee($comment['user']['profile']['image']);
            $response->assertSee($comment['user']['profile']['name']);
            $response->assertSee($comment['comment']);
        }
    }
}
