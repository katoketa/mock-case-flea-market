@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-page">
    <div class="item-image">
        <img src="{{ $item['image'] }}" alt="商品画像" class="item-image__img">
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
                <td class="item-data__table-condition">{{ $item['condition'] }}</td>
            </tr>
        </table>
        <h3 class="comments-header">コメント({{ $item['comments']->count() }})</h3>
        <div class="seller-profile">
            <div class="seller-profile__image">
                <!-- Todo:外部キーの名前変更を行う -->
                <img src="{{ $item['seller']" alt="" class="seller-profile__image-img">
            </div>
        </div>
    </div>
</div>
@endsection