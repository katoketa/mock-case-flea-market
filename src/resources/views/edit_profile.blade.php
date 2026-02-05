@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_profile.css') }}">
@endsection

@section('nav')
@include('navigation')
@endsection

@section('content')
<div class="edit-profile">
    <h2 class="edit-profile__header">プロフィール</h2>
    <form action="/mypage/profile" method="post" class="edit-form" novalidate>
        @csrf
        <div class="edit-profile__image">
            <div class="show-image">
                @if (!empty($user['profile']))
                <img src="{{ asset($user['profile']['image']) }}" alt="" class="show-image__img">
                @endif
            </div>
            <input type="file" name="image" id="" class="edit-image">
        </div>
        <label for="name" class="edit-profile__header">ユーザー名</label>
        <input type="text" name="name" id="name" class="edit-profile__input" @if (!empty($user['profile'])) value="{{ $user['name'] }}" @endif>
        <label for="postal-code" class="edit-profile__header">郵便番号</label>
        <input type="text" name="postal-code" id="postal-code" class="edit-profile__input" @if (!empty($user['profile'])) value="{{ $user['profile']['postal-code'] }}" @endif>
        <label for="address" class="edit-profile__header">住所</label>
        <input type="text" name="address" id="address" class="edit-profile__input" @if (!empty($user['profile'])) value="{{ $user['profile']['address'] }}" @endif>
        <label for="building" class="edit-profile__header">建物名</label>
        <input type="text" name="building" id="building" class="edit-profile__input" @if (!empty($user['profile'])) value="{{ $user['profile']['building'] }}" @endif>
        <button type="submit" class="edit-profile__button-submit">更新する</button>
    </form>
</div>
@endsection