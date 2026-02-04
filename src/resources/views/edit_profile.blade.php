@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_profile.css') }}">
@endsection

@section('content')
<div class="edit-profile">
    <h2 class="edit-profile__header">プロフィール</h2>
    <form action="/mypage" method="post" class="edit-form">
        @csrf
        <div class="edit-profile__image">
            <div class="show-image">
                <img src="{{ asset($user['profile']['image']) }}" alt="" class="show-image__img">
            </div>
            <input type="file" name="image" id="" class="edit-image">
        </div>
        <label for="name" class="edit-profile__name-header">ユーザー名</label>
        <input type="text" name="name" id="name" class="edit-profile__name-input" value="{{ $user['name'] }}">
        <!-- 続きはここから -->
    </form>
</div>
@endsection