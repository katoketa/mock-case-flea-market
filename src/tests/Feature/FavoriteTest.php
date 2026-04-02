<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;
    
    protected $seed = true;
    const SELECT_ITEM_ID = 3;
    const TEST_USER_ID = 1;

    /**
     * A basic feature test example.
     */
    public function testFavorite(): void
    {
        // いいねアイコンを押下することによって、いいねした商品として登録することができる
        $user = User::find(self::TEST_USER_ID);
        $this->actingAs($user);
        $response = $this->get('/item/' . self::SELECT_ITEM_ID);
        $response->assertStatus(200);
        $favoritesCountStale = Item::find(self::SELECT_ITEM_ID)->favorites->count();
        $response = $this->patch('/item/' . self::SELECT_ITEM_ID . '/favorite');
        $response->assertStatus(302);
        $response->assertRedirect('/item/' . self::SELECT_ITEM_ID);
        $this->assertDatabaseHas('favorites', [
            'user_id' => self::TEST_USER_ID,
            'item_id' => self::SELECT_ITEM_ID,
        ]);
        $favoritesCount = Item::find(self::SELECT_ITEM_ID)->favorites->count();
        $this->assertEquals($favoritesCountStale + 1, $favoritesCount);

        // 再度いいねアイコンを押下することによって、いいねを解除することができる
        $favoritesCountStale = $favoritesCount;
        $response = $this->delete('/item/' . self::SELECT_ITEM_ID . '/favorite');
        $response->assertStatus(302);
        $response->assertRedirect('/item/' . self::SELECT_ITEM_ID);
        $this->assertDatabaseMissing('favorites', [
            'user_id' => self::TEST_USER_ID,
            'item_id' => self::SELECT_ITEM_ID,
        ]);
        $favoritesCount = Item::find(self::SELECT_ITEM_ID)->favorites->count();
        $this->assertEquals($favoritesCountStale - 1, $favoritesCount);
    }
}
