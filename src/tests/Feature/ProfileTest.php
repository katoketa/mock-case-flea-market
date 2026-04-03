<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;
    const TEST_USER_ID = 3;
    /**
     * A basic feature test example.
     */
    public function testProfile(): void
    {
        // 必要な情報が取得できる
        $user = User::find(self::TEST_USER_ID);
        $this->actingAs($user);
        $response = $this->get('/mypage');
        $response->assertStatus(200);
        $response->assertSee($user['profile']['image']);
        $response->assertSee($user['name']);
        $items = $user->items;
        foreach ($items as $item) {
            $response->assertSee($item['name']);        // 出品した商品一覧の確認
        }
    }

    public function testProfileBuy(): void
    {
        $user = User::find(self::TEST_USER_ID);
        $this->actingAs($user);
        $response = $this->get('/mypage/?page=buy');
        $response->assertStatus(200);
        $purchaseHistories = $user['purchase_histories'];
        $purchaseHistories->load('item');
        foreach ($purchaseHistories as $purchaseHistory) {
            $response->assertSee($purchaseHistory['item']['name']);     // 購入した商品一覧の確認
        }
    }
}
