@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_profile.css') }}">
@endsection

@section('nav')
@include('navigation')
@endsection

@section('content')
<div class="edit-profile">
    <h2 class="edit-profile__header">プロフィール設定</h2>
    <form action="/mypage/profile" method="post" class="edit-form" enctype="multipart/form-data" novalidate>
        @csrf
        @if(!empty($user['profile']))
        <input type="hidden" name="id" value="{{ $user['profile']['id'] }}">
        @endif
        <div class="edit-form__image">
            <div class="show-image">
                @if (!empty($user['profile']))
                <img src="{{ asset($user['profile']['image']) }}" alt="" class="show-image__img">
                @endif
            </div>
            <label for="image" class="edit-image__label">画像を選択する</label>
            <input type="file" name="image" id="image" class="edit-image__input">
        </div>
        @error('image')
        <div class="error-message">{{ $message }}</div>
        @enderror
        <label for="name" class="edit-form__header">ユーザー名</label>
        @if (empty(old('name')))
        <input type="text" name="name" id="name" class="edit-form__input" @if (!empty($user['profile'])) value="{{ $user['name'] }}" @endif>
        @else
        <input type="text" name="name" id="name" class="edit-form__input" value="{{ old('name') }}">
        @endif
        @error('name')
        <div class="error-message">{{ $message }}</div>
        @enderror
        <label for="postal-code" class="edit-form__header">郵便番号</label>
        @if (empty(old('postal_code')))
        <input type="text" name="postal_code" id="postal_code" class="edit-form__input" @if (!empty($user['profile'])) value="{{ $user['profile']['postal_code'] }}" @endif>
        @else
        <input type="text" name="postal_code" id="postal_code" class="edit-form__input" value="{{ old('postal_code') }}">
        @endif
        @error('postal_code')
        <div class="error-message">{{ $message }}</div>
        @enderror
        <label for="address" class="edit-form__header">住所</label>
        @if (empty(old('address')))
        <input type="text" name="address" id="address" class="edit-form__input" @if (!empty($user['profile'])) value="{{ $user['profile']['address'] }}" @endif>
        @else
        <input type="text" name="address" id="address" class="edit-form__input" value="{{ old('address') }}">
        @endif
        @error('address')
        <div class="error-message">{{ $message }}</div>
        @enderror
        <label for="building" class="edit-form__header">建物名</label>
        @if (empty(old('building')))
        <input type="text" name="building" id="building" class="edit-form__input" @if (!empty($user['profile'])) value="{{ $user['profile']['building'] }}" @endif>
        @else
        <input type="text" name="building" id="building" class="edit-form__input" value="{{ old('building') }}">
        @endif
        <button type="submit" class="edit-form__button-submit">更新する</button>
    </form>
</div>
@endsection

@section('script')
<script>
    const fileInput = document.getElementById('image');
    const preview = document.querySelector('.show-image__img');
    fileInput.addEventListener('change', event => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener('load', event => {
                preview.src = event.target.result;
            });
            reader.readAsDataURL(file);
        }
    })
</script>
@endsection