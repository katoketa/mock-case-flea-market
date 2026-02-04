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
    @include('items_exhibition', ['showSoldState' => true])
@endsection