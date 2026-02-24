@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('nav')
@include('navigation')
@endsection

@section('content')
<div class="purchase">
    <div class="purchase-form">
        <div class="purchase-form__left">
            <div class="purchase-form__header">
                <div class="purchase-form__image">
                    <img src="{{ asset($item['image']) }}" alt="" class="purchase-form__image-img">
                </div>
                <div class="purchase-form__item">
                    <h2 class="purchase-form__item-name">{{ $item['name'] }}</h2>
                    <p class="purchase-form__item-price">¥  {{ $item['price'] }}</p>
                </div>
            </div>
            <div class="purchase-form__content">
                <div class="purchase-form__content-header">
                    <h3 class="payment-method__header">支払い方法</h3>
                </div>
                <div class="purchase-form__content-item">
                    <div class="payment-method__select-wrapper">
                        <select name="payment_method" id="" class="payment-method__select">
                            <option value="" selected hidden>選択してください</option>
                            <option value="payment_convenience" class="payment-method__option">コンビニ払い</option>
                            <option value="payment_card" class="payment-method__option">カード払い</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="purchase-form__content">
                <div class="purchase-form__content-header">
                    <h3 class="delivery-address__header-title">配送先</h3>
                    <a href="/purchase/address/{{ $item['id'] }}" class="delivery-address__change">変更する</a>
                </div>
                <div class="purchase-form__content-item">
                    @if (empty($destinationAddress))
                    <p class="delivery-address__postal-code">〒 {{ $profile['postal_code'] }}</p>
                    <div class="delivery-address__address-building">
                        <p class="delivery-address__address">{{ $profile['address'] }}</p>
                        <p class="delivery-address__building">{{ $profile['building'] }}</p>
                    </div>
                    @else
                    <p class="delivery-address__postal-code">{{ $destinationAddress['postal_code'] }}</p>
                    <div class="delivery-address__address-building">
                        <p class="delivery-address__address">{{ $destinationAddress['address'] }}</p>
                        <p class="delivery-address__building">{{ $destinationAddress['building'] }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="purchase-form__right">
            <table class="payment-info">
                <tr class="payment-info__tr">
                    <th class="payment-info__header">商品代金</th>
                    <td class="payment-info__item">¥ {{ $item['price'] }}</td>
                </tr>
                <tr class="payment-info__tr">
                    <th class="payment-info__header">支払い方法</th>
                    <td class="payment-info__item">javascript</td>
                </tr>
            </table>
            <div class="purchase-form__button">
                <button type="submit" class="purchase-form__button-submit">購入する</button>
            </div>
        </div>
    </div>
</div>
@endsection