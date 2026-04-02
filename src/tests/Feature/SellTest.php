<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;

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
        $image = UploadedFile::fake()->image('dummy.jpg', '300px', '300px')->size(100);
        dd($image);
        $formData = [
            'name' => 'ゲーミングノートPC',
            'categories' => [1, 2, 3],
            'condition_id' => 1,
            'brand' => 'orange',
            'description' => 'とても高性能なゲーミングPCです',
            'price' => 199999,
        ];

    }
}
