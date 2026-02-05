@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_profile.css') }}">
@endsection

@section('content')
<div class="edit-profile">
    <h2 class="edit-profile__header">プロフィール</h2>
    <form action="/mypage" method="post" class="edit-form" novalidate>
        @csrf
        <div class="edit-profile__image">
            <div class="show-image">
                <img src="{{ asset($user['profile']['image']) }}" alt="" class="show-image__img">
            </div>
            <input type="file" name="image" id="" class="edit-image">
        </div>
        <label for="name" class="edit-profile__header">ユーザー名</label>
        <input type="text" name="name" id="name" class="edit-profile__input" value="{{ $user['name'] }}">
        <label for="postal-code" class="edit-profile__header">郵便番号</label>
        <input type="text" name="postal-code" id="postal-code" class="edit-profile__input" value="{{ $user['profile']['postal-code'] }}">
        <label for="address" class="edit-profile__header">住所</label>
        <input type="text" name="address" id="address" class="edit-profile__input" value="{{ $user['profile']['address'] }}">
        <label for="building" class="edit-profile__header">建物名</label>
        <input type="text" name="building" id="building" class="edit-profile__input" value="{{ $user['profile']['building'] }}">
        <button type="submit" class="edit-profile__button-submit">更新する</button>
    </form>
</div>
@endsection