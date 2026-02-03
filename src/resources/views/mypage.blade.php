@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('nav')
@include('navigation')
@endsection

@section('content')
<div class="mypage">
    <div class="mypage-header">
        <div class="mypage-header__user-profile">
            <div class="mypage-header__image">
                @if (!empty($user['profile']))
                <img src="{{ $user['profile']['image'] }}" alt="" class="mypage-header__image-img">
                @endif
            </div>
            <p class="mypage-header__user-name">{{ $user['name'] }}</p>
        </div>
        <div class="mypage-header__profile-edit">
            <a href="/mypage/profile" class="mypage-header__edit-button">プロフィールを編集</a>
        </div>
    </div>
    <div class="mypage-items">
        <div class="mypage-items__header">
                @if (empty($page) || $page === "sell")
                <p class="mypage-items__header mypage-items__header-select">出品した商品</p>
                <a href="/mypage/?page=buy" class="mypage-items__header">購入した商品</a>
                @elseif ($page === "buy")
                <a href="/mypage/?page=sell" class="mypage-items__header">出品した商品</a>
                <p class="mypage-items__header mypage-items__header-select">購入した商品</p>
                @endif
        </div>
        @include('items_exhibition', ['showSoldState' => false])
    </div>
</div>
@endsection