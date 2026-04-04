<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class SellTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $seed = true;
    /**
     * A basic feature test example.
     */
    public function testSell(): void
    {
        // 商品出品画面にて必要な情報が保存できること
        Storage::fake();
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/sell');
        $response->assertStatus(200);
        $image = UploadedFile::fake()->image('dummy.png', 300, 300)->size(100);
        $formData = [
            'image' => $image,
            'name' => 'ゲーミングノートPC',
            'categories' => [1, 2, 3],
            'condition_id' => 1,
            'brand' => 'orange',
            'description' => 'とても高性能なゲーミングPCです',
            'price' => 199999,
        ];
        $response = $this->post('/sell', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        unset($formData['image']);
        $categories = $formData['categories'];
        unset($formData['categories']);
        $this->assertDatabaseHas('items', $formData);
        $latestItem = Item::latest()->first()->toArray();
        foreach ($categories as $category) {
            $this->assertDatabaseHas('category_item', [
                'item_id' => $latestItem['id'],
                'category_id' => $category,
            ]);
        }
    }
}
