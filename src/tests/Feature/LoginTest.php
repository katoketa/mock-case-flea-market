<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    private function getRegisterData(): array
    {
        return [
            'name' => '田辺敦子',
            'email' => 'coachtech102@gmail.com',
            'password' => 'coachtech102',
            'password_confirmation' => 'coachtech102',
        ];
    }
    /**
     * A basic feature test example.
     */
    public function testLoginValidateEmail(): void
    {
        $registerData = $this->getRegisterData();
        $this->post('/register', $registerData);
        $response = $this->post('/logout');

        // メールアドレスが入力されていない場合、バリデーションメッセージが表示される
        $formData = [
            'password' => 'coachtech102',
        ];
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response = $this->post('/login', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
    }

    public function testLoginValidatePassword(): void
    {
        $registerData = $this->getRegisterData();
        $this->post('/register', $registerData);
        $response = $this->post('/logout');

        // パスワードが入力されていない場合、バリデーションメッセージが表示される
        $formData = [
            'email' => 'coachtech102@gmail.com'
        ];
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response = $this->post('/login', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
    }

    public function testLoginFailed(): void
    {
        $registerData = $this->getRegisterData();
        $this->post('/register', $registerData);
        $response = $this->post('/logout');

        //  入力情報が間違っている場合、バリデーションメッセージが表示される
        $formData = [
            'email' => 'coachtech100@gmail.com',
            'password' => 'coachtech102'
        ];
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response = $this->post('/login', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors(['email' => 'ログイン情報が登録されていません']);
    }

    public function testLoginSuccess(): void
    {
        $registerData = $this->getRegisterData();
        $this->post('/register', $registerData);
        $response = $this->post('/logout');

        // 正しい情報が入力された場合、ログイン処理が実行される
        $formData = [
            'email' => 'coachtech102@gmail.com',
            'password' => 'coachtech102'
        ];
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response = $this->post('/login', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHasNoErrors();
    }
}
