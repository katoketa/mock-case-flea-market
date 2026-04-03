<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    /**
     * A basic feature test example.
     */
    public function testRegisterValidateNameRequired(): void
    {
        // 名前が入力されていない場合、バリデーションメッセージが表示される
        $formData = [
            'email' => 'coachtech@gmail.com',
            'password' => 'coachtech1',
            'password_confirmation' => 'coachtech1',
        ];
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response = $this->post('/register', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['name' => 'お名前を入力してください']);
    }
    
    public function testRegisterValidateEmailValidate(): void
    {
        // メールアドレスが入力されていない場合、バリデーションメッセージが表示される
        $formData = [
            'name' => '河内徹子',
            'password' => 'coachtech1',
            'password_confirmation' => 'coachtech1',
        ];
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response = $this->post('/register', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
    }

    public function testRegisterValidatePasswordRequired(): void
    {
        // パスワードが入力されていない場合、バリデーションメッセージが表示される
        $formData = [
            'name' => '河内徹子',
            'email' => 'coachtech@gmail.com',
            'password_confirmation' => 'coachtech1',
        ];
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response = $this->post('/register', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
    }

    public function testRegisterValidatePasswordMin(): void
    {
        // パスワードが7文字以下の場合、バリデーションメッセージが表示される
        $formData = [
            'name' => '河内徹子',
            'email' => 'coachtech@gmail.com',
            'password' => 'coachte',
            'password_confirmation' => 'coachte',
        ];
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response = $this->post('/register', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password' => 'パスワードは8文字以上で入力してください']);
    }

    public function testRegisterValidatePasswordConfirmation(): void
    {
        // パスワードが確認用パスワードと一致しない場合、バリデーションメッセージが表示される
        $formData = [
            'name' => '河内徹子',
            'email' => 'coachtech@gmail.com',
            'password' => 'coachtech1',
            'password_confirmation' => 'coachtech2',
        ];
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response = $this->post('/register', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password_confirmation' => 'パスワードと一致しません']);
    }

    public function testRegisterSuccess(): void
    {
        // 全ての項目が入力されている場合、会員情報が登録され、プロフィール設定画面に遷移される
        $formData = [
            'name' => '河内徹子',
            'email' => 'coachtech@gmail.com',
            'password' => 'coachtech1',
            'password_confirmation' => 'coachtech1',
        ];
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response = $this->followingRedirects()->post('/register', $formData);
        $response->assertStatus(200);
        $response->assertSee('プロフィール設定');
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', [
            'name' => '河内徹子',
            'email' => 'coachtech@gmail.com'
        ]);
    }
}
