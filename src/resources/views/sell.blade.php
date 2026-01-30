@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('nav')
@include('navigation')
@endsection

@section('content')
<div class="sell-page">
    <h2 class="sell-page__header-title">商品の出品</h2>
    <form action="/" method="post" class="sell-form">
        @csrf
        <div class="sell-page__image-upload">
            <label class="image-upload__header">商品画像</label>
            <div class="image-upload">
                <input type="file" name="image" id="image" class="image-upload__input">
            </div>
        </div>
        <div class="sell-page__detail">
            <h3 class="sell-form__detail-header">商品の詳細</h3>
            <label class="detail-categories__header">カテゴリー</label>
            <div class="detail-categories">
                @foreach ($categories as $category)
                <input type="checkbox" name="category[]" id="category{{ $category['id'] }}" class="detail-category">
                <label for="category{{ $category['id'] }}" class="detail-category__label">{{ $category['name'] }}</label>
                @endforeach
            </div>
            <div class="detail-condition">
                <label class="detail-condition__header">商品の状態</label>
                <select name="condition" id="" class="detail-condition__select">
                    @foreach ($conditions as $condition)
                    <option value="{{ $condition['id'] }}" class="detail-condition__option">{{ $condition['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sell-page__item">
                <h3 class="sell-page__item-header">商品名と説明</h3>
                <label class="item-name__header">商品名</label>
                <input type="text" name="name" class="item-name__input">
                <label class="item-brand__header">ブランド名</label>
                <input type="text" name="brand" id="" class="item-brand__input">
                <label class="item-description__header">商品の説明</label>
                <textarea name="description" id="" class="item-description__textarea"></textarea>
                <label class="item-price__header">販売価格</label>
                <input type="number" name="price" id="">
                <div class="sell-form__button">
                    <button type="submit" class="sell-form__button-submit">出品する</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection