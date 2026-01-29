@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('nav')
@include('navigation')
@endsection

@section('content')
<div class="index-page">
    <div class="index-page__header">
        @if (empty($tab))
        <span class="page-tab page-tab__select">おすすめ</span>
        @else
        <a href="/" class="page-tab">おすすめ</a>
        @endif
        @if (!empty($tab) && $tab === 'mylist')
        <span class="page-tab page-tab__select">マイリスト</span>
        @else
        <a href="/?tab=mylist" class="page-tab">マイリスト</a>
        @endif
    </div>
    <div class="index-page__exhibition">
        @foreach ($items as $item)
        <!-- Todo:出品ページ作成以降、挙動を要確認 -->
        @if ($item['seller']['id'] === auth()->user()->id)
        @continue
        @endif
        @if (empty($item['purchase_history']))
        <a href="/item/{{ $item['id'] }}" class="exhibition-card">
            <div class="exhibition-card__image">
                <img src="{{ asset($item['image']) }}" alt="商品画像" class="exhibition-card__image-img">
            </div>
            <p class="exhibition-card__name">{{ $item['name'] }}</p>
        </a>
        @else
        <div class="exhibition-card">
            <div class="exhibition-card__image">
                <img src="{{ asset($item['image']) }}" alt="商品画像" class="exhibition-card__image-img image-img__sold">
                <!-- TODO：SOLDの位置調整(認証ルーティング実装後予定) -->
                <p class="exhibition-card__image-sold">SOLD</p>
            </div>
            <p class="exhibition-card__name">{{ $item['name'] }}</p>
        </div>
        @endif
        @endforeach
    </div>
    @endsection