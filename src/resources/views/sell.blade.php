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
    <form action="/sell" method="post" class="sell-form" enctype="multipart/form-data">
        @csrf
        <div class="sell-form__image-upload">
            <h3 class="image-upload__header">商品画像</h3>
            <div class="image-upload">
                <div class="image-upload__image">
                    <img src="" alt="" id="image-upload__image-img" class="image-upload__image-img">
                </div>
                <label for="image" class="image-upload__label">
                    画像を選択する
                </label>
                <input type="file" name="image" id="image" class="image-upload__input">
            </div>
        </div>
        @error('image')
        <div class="error-message">{{ $message }}</div>
        @enderror
        <div class="sell-form__detail">
            <h3 class="sell-form__content-header">商品の詳細</h3>
            <h4 class="detail-categories__header">カテゴリー</h4>
            <div class="detail-categories">
                @foreach ($categories as $category)
                <input type="checkbox" name="categories[]" id="category{{ $category['id'] }}" class="detail-category__checkbox" value="{{ $category['id'] }}">
                <label for="category{{ $category['id'] }}" class="detail-category__label">{{ $category['name'] }}</label>
                @endforeach
            </div>
            @error('categories')
            <div class="error-message">{{ $message }}</div>
            @enderror
            <div class="detail-condition">
                <label class="detail-condition__header">商品の状態</label>
                <div class="detail-condition__select-wrapper">
                    <select name="condition_id" id="" class="detail-condition__select">
                        <option value="" class="detail-condition__option" selected hidden>選択してください</option>
                        @foreach ($conditions as $condition)
                        <option value="{{ $condition['id'] }}" class="detail-condition__option">{{ $condition['name'] }}</option>
                        @endforeach
                    </select>
                    @error('condition_id')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="sell-form__item">
            <h3 class="sell-form__content-header">商品名と説明</h3>
            <label class="item__header">商品名</label>
            <input type="text" name="name" class="item__input">
            @error('name')
            <div class="error-message">{{ $message }}</div>
            @enderror
            <label class="item__header">ブランド名</label>
            <input type="text" name="brand" id="" class="item__input">
            <label class="item__header">商品の説明</label>
            <textarea name="description" id="" class="item__textarea"></textarea>
            @error('description')
            <div class="error-message">{{ $message }}</div>
            @enderror
            <label class="item__header">販売価格</label>
            <div class="item__price">
                <input type="text" name="price" id="" class="item__input item__input--price">
            </div>
            @error('price')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="sell-form__button-submit">出品する</button>
    </form>
</div>
@endsection

@section('script')
<script>
    const image = document.getElementById('image');
    image.addEventListener('change', (e) => {
        const file = e.target.files[0];
        const fileReader = new FileReader();
        fileReader.readAsDataURL(file);

        fileReader.addEventListener('load', (e) => {
            const targetElement = document.getElementById('image-upload__image-img');
            targetElement.src = e.target.result;
        });

        const uploadImage = document.querySelector(".image-upload__image");
        uploadImage.style.marginBottom = "20px";
        uploadImage.style.height = "100%";
    });
</script>
@endsection