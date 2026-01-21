@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-page">
    <div class="register-page__header">
        <h2 class="register-page__header-title">会員登録</h2>
    </div>
    <form action="/register" method="post" class="register-form" novalidate>
        @csrf
        <label class="register-form__label">ユーザー名</label>
        <input type="text" name="name" class="register-form__input">
        <label class="register-form__label">メールアドレス</label>
        <input type="email" name="email" class="register-form__input">
        <label for="" class="register-form__label">パスワード</label>
        <input type="password" name="password" id="" class="register-form__input">
        <label for="" class="register-form__label">確認用パスワード</label>
        <input type="password" name="password_confirmation" id="" class="register-form__input">
        <div class="register-form__button">
            <button type="submit" class="register-form__button-submit">登録する</button>
        </div>
    </form>
    <a href="/login" class="register-page__transition-login">ログインはこちら</a>
</div>
@endsection