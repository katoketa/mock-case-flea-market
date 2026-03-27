@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('nav')
@import('navigation')
@endsection

@section('content')
<div class="verify-email">
    <p class="verify-email__text">登録していただいたメールアドレスに認証メールを送付しました。</p>
    <p class="verify-email__text">メール認証を完了してください。</p>
    <a href="" class="verify-email__button">認証はこちらから</a>
    <form action="/email/verification-notification" method="post" class="resend-form">
        @csrf
        <button type="submit" class="resend-form__button-submit">認証メールを再送する</button>
    </form>
</div>
@endsection