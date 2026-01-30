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
        <div class="sell-page__image-upload">
            <h4 class="image-upload__header">商品画像</h4>
            <div class="image-upload">
                <input type="file" name="image" id="image" class="image-upload__input">
            </div>
        </div>
        <div class="sell-page__detail">
            <h3 class="sell-form__detail-header">商品の詳細</h3>
            <h4 class="detail-categories__header">カテゴリー</h4>
            <div class="detail-categories">
                @foreach ($categories as $category)
                <input type="checkbox" name="category{{ $category['id'] }}" id="" class="detail-category">
                @endforeach
            </div>
        </div>
    </form>
</div>
@endsection