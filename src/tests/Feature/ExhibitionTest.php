<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;

class ExhibitionTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;
    /**
     * A basic feature test example.
     */
    public function testExhibition(): void
    {
        // 商品一覧ページを開く
        $response = $this->get('/');
        $response->assertStatus(200);

        // 全商品を取得できる
        $countItems = Item::all()->count();
        $this->assertCount($countItems, $response['items']);

        // 購入済み商品は「Sold」と表示される
        $response->assertSee('Sold');
    }

    public function testExhibitionAfterLogin(): void
    {
        // 自分が出品した商品は表示されない
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/');
        $response->assertStatus(200);
        $this->assertNotEmpty($response['items']);
        $userSellItems = Item::where('seller_id', $user['id'])->get();
        foreach ($userSellItems as $userSellItem) {
            $response->assertDontSee($userSellItem['name']);
        }
    }
}
