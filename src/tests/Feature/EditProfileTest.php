<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class EditProfileTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;
    /**
     * A basic feature test example.
     */
    public function testEditProfile(): void
    {
        // 変更項目が初期値として過去設定されていること
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/mypage/profile');
        $response->assertStatus(200);
        $response->assertSee($user['image']);
        $response->assertSee($user['name']);
        $response->assertSee($user['postal_code']);
        $response->assertSee($user['address']);
    }
}
