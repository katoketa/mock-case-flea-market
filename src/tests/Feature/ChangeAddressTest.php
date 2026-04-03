<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ChangeAddressTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;
    const SELECT_ITEM_ID = 5;
    /**
     * A basic feature test example.
     */
    public function testChangeAddress(): void
    {
        // 送付先変更画面にて登録した住所が商品購入画面に反映されている
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/purchase/' . self::SELECT_ITEM_ID);
        $response->assertStatus(200);
        $formData = [
            'postal_code' => '123-3445',
            'address' => '東京都世田谷区のどこか',
            'building' => 'マンション322号室'
        ];
        $response = $this->followingRedirects()->post('purchase/' . self::SELECT_ITEM_ID, $formData);
        $response->assertStatus(200);
        foreach ($formData as $data) {
            $response->assertSee($data);
        }

        // 購入した商品に送付先住所が紐づいて登録される
        $formData['payment_method'] = 'payment_card';
        $response = $this->post('/purchase/payment/' . self::SELECT_ITEM_ID, $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        unset($formData['payment_method']);
        $purchaseHistory = [
            'buyer_id' => $user['id'],
            'item_id' => self::SELECT_ITEM_ID,
            'postal_code' => $formData['postal_code'],
            'address' => $formData['address'],
            'building' => $formData['building'],
        ];
        $this->assertDatabaseHas('purchase_histories', $purchaseHistory);
    }
}
