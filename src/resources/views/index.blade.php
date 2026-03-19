@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/items-exhibition.css') }}">
@endsection

@section('nav')
@include('navigation')
@endsection

@section('content')
<div class="index-page">
    <div class="index-page__header">
        @if (empty($tab))
        <div class="page-tab page-tab__select">おすすめ</div>
        @else
        <form action="/" method="get">
            @if (!empty($keyword))
            <input type="hidden" name="keyword" value="{{ $keyword }}">
            @endif
            <button type="submit" class="page-tab">おすすめ</button>
        </form>
        @endif
        @if (!empty($tab) && $tab === 'mylist')
        <div class="page-tab page-tab__select">マイリスト</div>
        @else
        <form action="/" method="get">
            <input type="hidden" name="tab" value="mylist">
            @if (!empty($keyword))
            <input type="hidden" name="keyword" value="{{ $keyword }}">
            @endif
            <button type="submit" class="page-tab">マイリスト</button>
        </form>
        @endif
    </div>
    @include('items_exhibition', ['showSoldState' => true])
    @endsection