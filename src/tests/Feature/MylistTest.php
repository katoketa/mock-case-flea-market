<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class MylistTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    /**
     * A basic feature test example.
     */
    public function testMylist(): void
    {
        // いいねした商品だけが表示される
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/?tab=mylist');
        $response->assertStatus(200);
        $favoriteItems = $user['favorites'];
        foreach ($favoriteItems as $favoriteItem) {
            $response->assertSee($favoriteItem['name']);
        }
        $favoriteItemsId = array_column($favoriteItems->toArray(), 'id');
        $exclusionItems = Item::whereNotIn('id', $favoriteItemsId)->get();
        foreach ($exclusionItems as $exclusionItem) {
            $response->assertDontSee($exclusionItem['name']);
        }

        // 購入済み商品は「Sold」と表示される
        $response->assertSee('Sold');
    }
}
