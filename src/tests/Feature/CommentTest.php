<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $seed = true;
    const SELECT_ITEM_ID = 4;

    /**
     * A basic feature test example.
     */
    public function testCommentSuccess(): void
    {
        // ログイン済みのユーザーはコメントを送信できる
        $user = User::find(1);
        $this->actingAS($user);
        $commentCountStale = Item::find(self::SELECT_ITEM_ID)->comments->count();
        $response = $this->post('/item/' . self::SELECT_ITEM_ID . '/comment', [
            'user_id' => $user['id'],
            'comment' => 'これはテストコメントです',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/item/' . self::SELECT_ITEM_ID);
        $this->assertDatabaseHas('comments', [
            'user_id' => $user['id'],
            'item_id' => self::SELECT_ITEM_ID,
            'comment' => 'これはテストコメントです'
        ]);
        $commentCount = Item::find(self::SELECT_ITEM_ID)->comments->count();
        $this->assertEquals($commentCountStale + 1, $commentCount);
    }

    public function testCommentGuest(): void
    {
        // ログイン前のユーザーはコメントを送信できない
        $this->assertGuest();
        $response = $this->post('/item/' . self::SELECT_ITEM_ID . '/comment', [
            'user_id' => 1,
            'comment' => 'これはテストコメントです',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('comments', [
            'user_id' => 1,
            'comment' => 'これはテストコメントです',
        ]);
    }

    public function testCommentValidateRequired(): void
    {
        // コメントが入力されていない場合、バリデーションメッセージが表示される
        $user = User::find(1);
        $this->actingAs($user);
        $this->assertAuthenticated();
        $response = $this->post('/item/' . self::SELECT_ITEM_ID . '/comment', [
            'user_id' => $user['id'],
            'comment' => '',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['comment' => 'コメントが入力されていません']);
    }

    public function testCommentValidateMax(): void
    {
        // コメントが255文字以上の場合、バリデーションメッセージが表示される
        $user = User::find(1);
        $this->actingAs($user);
        $this->assertAuthenticated();
        $response = $this->post('/item/' . self::SELECT_ITEM_ID . '/comment', [
            'user_id' => $user['id'],
            'comment' => $this->faker->realText(300),
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['comment' => 'コメントが255文字を超えています']);
    }
}
