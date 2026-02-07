@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/change_address.css') }}">
@endsection

@section('nav')
@include('navigation')
@endsecrion

@section('content')
<div class="change-address">
    <h2 class="change-address__header">住所の変更</h2>
    <form action="/purchase/{{ $item['id'] }}" method="post" class="change-address-form">
        @csrf
        <label for="postal-code" class="change-address-form__label">郵便番号</label>
        <input type="text" name="postal-code" id="postal-code" class="change-address-form__input">
        <label for="address" class="change-address-form__label">住所</label>
        <input type="text" name="address" id="address" class="change-address-form__input">
        <label for="building" class="change-address-form__label">建物名</label>
        <input type="text" name="building" id="building" class="change-address-form__input">
        <div class="change-address-form__button">
            <button class="change-address-form__button-submit">更新する</button>
        </div>
    </form>
</div>
@endsection