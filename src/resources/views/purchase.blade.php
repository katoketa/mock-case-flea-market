@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('nav')
@include('navigation')
@endsection

@section('content')
<div class="purchase">
    <form action="/purchase/payment/{{ $item['id'] }}" method="post" class="purchase-form">
        @csrf
        <div class="purchase-form__left">
            <div class="purchase-form__header">
                <div class="purchase-form__image">
                    <img src="{{ asset($item['image']) }}" alt="" class="purchase-form__image-img">
                </div>
                <div class="purchase-form__item">
                    <h2 class="purchase-form__item-name">{{ $item['name'] }}</h2>
                    <p class="purchase-form__item-price">
                        ¥ <span id="purchase-form__item-price" class="purchase-form__item-price-inner">{{ $item['price'] }}</span>
                    </p>
                </div>
            </div>
            <div class="purchase-form__content">
                <div class="purchase-form__content-header">
                    <h3 class="payment-method__header">支払い方法</h3>
                </div>
                <div class="purchase-form__content-item">
                    <div class="payment-method__select-wrapper">
                        <select name="payment_method" id="select-toggle" class="payment-method__select">
                            <option value="" selected hidden>選択してください</option>
                            <option value="payment_convenience" class="payment-method__option">コンビニ支払い</option>
                            <option value="payment_card" class="payment-method__option">カード支払い</option>
                        </select>
                        @error('payment_method')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
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
                    <p class="delivery-address__postal-code-wrapper">
                        〒 <input type="text" name="postal_code" class="delivery-address__postal-code" value="{{ $user['profile']['postal_code'] }}" readonly>
                    </p>
                    <div class="delivery-address__address-building">
                        <input type="text" name="address"  id="address" class="delivery-address__address" value="{{ $user['profile']['address'] }}" readonly>
                        <input type="text" name="building" class="delivery-address__building" value="{{ $user['profile']['building'] }}" readonly>
                    </div>
                    @else
                    <p class="delivery-address__postal-code">
                        〒 <input type="text" name="postal_code" class="delivery-address__postal-code" value="{{ $destinationAddress['postal_code'] }}" readonly>
                    </p>
                    <div class="delivery-address__address-building">
                        <input type="text" name="address" id="address" class="delivery-address__address" value="{{ $destinationAddress['address'] }}" readonly>
                        <input type="text" name="building" class="delivery-address__building" value="{{ $destinationAddress['building'] }}" readonly>
                    </div>
                    @endif
                    @error('postal_code')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                    @error('address')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="purchase-form__right">
            <table class="payment-info">
                <tr class="payment-info__tr">
                    <th class="payment-info__header">商品代金</th>
                    <td class="payment-info__item">
                        ¥ <span id="payment-info__item-price" class="payment-info__item-price">{{ $item['price'] }}</span>
                    </td>
                </tr>
                <tr class="payment-info__tr">
                    <th class="payment-info__header">支払い方法</th>
                    <td class="payment-info__item">
                        <div class="payment-info__item-inner is-active">未選択</div>
                        <div id="payment_convenience" class="payment-info__item-inner">コンビニ支払い</div>
                        <div id="payment_card" class="payment-info__item-inner">カード支払い</div>
                    </td>
                </tr>
            </table>
            @if ($user['id'] === $item['seller_id'])
            <div class="purchase-form__button-submit purchase-form__button-submit--my-item">購入する</div>
            @else
            <button type="submit" class="purchase-form__button-submit">購入する</button>
            @endif
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    const price = @json($item['price']);
    document.getElementById('purchase-form__item-price').innerText = price.toLocaleString("ja-JP");
    document.getElementById('payment-info__item-price').innerText = price.toLocaleString("ja-JP");

    const selectToggle = document.getElementById('select-toggle');
    if (selectToggle) {
        selectToggle.value = "";
        selectToggle.addEventListener('change', () => {
            document.querySelectorAll('.payment-info__item-inner').forEach(selectPayment => {
                selectPayment.classList.toggle('is-active', selectToggle.value === selectPayment.id);
            })
        })
    }

    const ctx = document.createElement('canvas').getContext('2d');
    ctx.font = '15px "Inter"';
    const address = document.getElementById('address');
    console.log(address.value);
    const width = ctx.measureText(address.value).width;
    console.log(width);
    address.style.width = String(width) + "px";
</script>
@endsection