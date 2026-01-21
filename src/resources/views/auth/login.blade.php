@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-page">
    <div class="login-page__header">
        <h2>ログイン</h2>
    </div>
    <form action="/login" method="post" class="login-form">
        @csrf
        <label for="" class="login-form__label">メールアドレス</label>
        <input type="email" name="email" id="" class="login-form__input">
        <label for="" class="login-form__label">パスワード</label>
        <input type="password" name="password" id="" class="login-form__input">
        <div class="login-form__button">
            <button type="submit" class="login-form__button-submit">ログインする</button>
        </div>
    </form>
    <a href="/register" class="login-page__transition-register">会員登録はこちら</a>
</div>
@endsection