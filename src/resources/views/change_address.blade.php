@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/change_address.css') }}">
@endsection

@section('nav')
@include('navigation')
@endsection

@section('content')
<div class="change-address-page">
    <h2 class="page-header">住所の変更</h2>
    <form action="/purchase/address/{{ $item['id'] }}" method="post" class="page-form">
        @csrf
        <label for="postal-code" class="page-form__label">郵便番号</label>
        <input type="text" name="postal_code" id="postal-code" class="page-form__input">
        <label for="address" class="page-form__label">住所</label>
        <input type="text" name="address" id="address" class="page-form__input">
        <label for="building" class="page-form__label">建物名</label>
        <input type="text" name="building" id="building" class="page-form__input">
        <div class="page-form__button">
            <button class="page-form__button-submit">更新する</button>
        </div>
    </form>
</div>
@endsection