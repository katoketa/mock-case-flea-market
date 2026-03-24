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
        <p class="item-price">¥<span id="item-price" class="item-price__value">{{ $item['price'] }}</span>(税込)</p>
        <div class="item-utilities">
            <div class="utilities-favorite">
                <form action="/item/{{ $item['id'] }}" method="post" class="favorite-icon" id="favorite-icon__login">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="favorite-icon__button-submit">
                        <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" alt="♡" class="favorite-icon__img">
                    </button>
                </form>
                <form action="/item/{{ $item['id'] }}" method="post" class="favorite-icon" id="favorite-icon__pink">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="favorite-icon__button-submit">
                        <img src="{{ asset('images/ハートロゴ_ピンク.png') }}" alt="❤️" class="favorite-icon__img">
                    </button>
                </form>
                <a href="/login" class="favorite-icon" id="favorite-icon__default">
                    <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" alt="♡" class="favorite-icon__img">
                </a>
                <p class="favorite-count">{{ $item['favorites']->count() }}</p>
            </div>
            <div class="utilities-comment">
                <div class="comment-icon">
                    <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="コメント数" class="comment-icon__img">
                </div>
                <p class="comment-count">{{ $item['comments']->count() }}</p>
            </div>
        </div>
        @if (!empty($user) ? $user['id'] : false === $item['seller_id'] || !empty($item['purchase_history']))
        <div class="transition__purchase-page transition__purchase-page--gray">売り切れ</div>
        @else
        <a href="/purchase/{{ $item['id'] }}" class="transition__purchase-page">購入手続きへ</a>
        @endif
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
                @if (!empty($comment['user']['profile']['image']))
                <img src="{{ asset($comment['user']['profile']['image']) }}" alt="" class="comment-user__image-img">
                @endif
            </div>
            <p class="comment-user__name">{{ $comment['user']['name'] }}</p>
        </div>
        <p class="comment-content">{{ $comment['comment'] }}</p>
        @endforeach
        <form action="/item/{{ $item['id'] }}" method="post" class="comment-form">
            @csrf
            @auth
            <input type="hidden" name="user_id" value="{{ $user['id'] }}">
            @endauth
            <input type="hidden" name="item_id" value="{{ $item['id'] }}">
            <h3 class="comment-form__header">商品へのコメント</h3>
            <textarea name="comment" id="" class="comment-form__textarea">{{ old('comment') }}</textarea>
            @error('comment')
            <div class="error-message">{{ $message }}</div>
            @enderror
            <button type="submit" class="comment-form__button-submit">コメントを送信する</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    function changeFavoriteIcon(isActiveIcon) {
        document.querySelectorAll('.favorite-icon').forEach(favoriteIcon => {
            favoriteIcon.classList.toggle('is-active__block', isActiveIcon === favoriteIcon.id);
        })
    }

    const price = @json($item['price']);
    document.getElementById('item-price').innerText = price.toLocaleString("ja-JP");

    const itemId = @json($item['id']);
    const user = @json($user);
    const favorites = @json($favorites);
    if (user) {
        const favorite = favorites.find(({
            id
        }) => id === itemId);
        if (favorite) {
            changeFavoriteIcon('favorite-icon__pink');
        } else {
            changeFavoriteIcon('favorite-icon__login');
        }
    } else {
        changeFavoriteIcon('favorite-icon__default');
    }
</script>
@endsection