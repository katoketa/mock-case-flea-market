@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('nav')
@include('navigation')
@endsection

@section('content')
<div class="detail-page">
    <div class="item-image">
        <img src="{{ asset($item['image']) }}" alt="商品画像" class="item-image__img">
    </div>
    <div class="item-detail">
        <h2 class="item-name">{{ $item['name'] }}</h2>
        <p class="item-brand">{{ $item['brand'] }}</p>
        <p class="item-price">¥<span class="item-price__value">{{ $item['price'] }}</span>(税込)</p>
        <div class="item-utilities">
            <div class="utilities-favorite">
                <!-- Todo:いいねボタンを押せるように変更する -->
                <div class="favorite-icon">
                    <!-- Todo:すでにいいねしている商品ならハートロゴをピンクにする -->
                    <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" alt="♡" class="favorite-icon__img">
                </div>
                <p class="favorite-count">{{ $item['favorites']->count() }}</p>
            </div>
            <div class="utilities-comment">
                <!-- Todo：コメントのアイコンを押した時に何か起こる機能要件があるか確認、なければコメントまで移動か -->
                <div class="comment-icon">
                    <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="コメント数" class="comment-icon__img">
                </div>
                <p class="comment-count">{{ $item['comments']->count() }}</p>
            </div>
        </div>
        <a href="/purchase/{{ $item['id'] }}" class="transition-purchase-page">購入手続きへ</a>
        <div class="item-description">
            <h3 class="item-description__title">商品説明</h3>
            <div class="item-description__content">{{ $item['description'] }}</div>
        </div>
        <h3 class="item-data__header">商品の情報</h3>
        <table class="item-data__table">
            <tr>
                <th class="item-data__table-header">カテゴリー</th>
                <td class="item-data__table-categories">
                    @foreach ($item['categories'] as $category)
                    <span class="item-data__table-category">{{ $category['name'] }}</span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th class="item-data__table-header">商品の状態</th>
                <td class="item-data__table-condition">{{ $item['condition']['name'] }}</td>
            </tr>
        </table>
        <h3 class="comments-header">コメント({{ $item['comments']->count() }})</h3>
        @foreach ($item['comments'] as $comment)
        <div class="comment-user">
            <div class="comment-user__image">
                <img src="{{ $comment['user']['profile']['image'] }}" alt="" class="comment-user__image-img">
            </div>
            <p class="comment-user__name">{{ $comment['user']['name'] }}</p>
        </div>
        <p class="comment-content">{{ $comment['comment'] }}</p>
        @endforeach
        <form action="/item/{{ $item['id'] }}" method="post" class="comment-form">
            @csrf
            <h2 class="comment-form__header">商品へのコメント</h2>
            <textarea name="comment" id="" class="comment-form__textarea"></textarea>
            <div class="comment-form__button">
                <button type="button" class="comment-form__button-submit">コメントを送信する</button>
            </div>
        </form>
    </div>
</div>
@endsection