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
    <form action="/purchase/{{ $item['id'] }}" method="post">
        @csrf
        <label for="postal-code" class="page-form__label">郵便番号</label>
        <input type="text" name="postal_code" id="postal-code" class="page-form__input" value="{{ old('postal_code') }}">
        @error('postal_code')
        <div class="error-message">{{ $message }}</div>
        @enderror
        <label for="address" class="page-form__label">住所</label>
        <input type="text" name="address" id="address" class="page-form__input" value="{{ old('address') }}">
        @error('address')
        <div class="error-message">{{ $message }}</div>
        @enderror
        <label for="building" class="page-form__label">建物名</label>
        <input type="text" name="building" id="building" class="page-form__input" value="{{ old('building') }}">
        <button class="page-form__button-submit">更新する</button>
    </form>
</div>
@endsection