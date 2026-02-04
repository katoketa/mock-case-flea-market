<div class="item-exhibition">
    @foreach ($items as $item)
    <a href="/item/{{ $item['id'] }}" class="exhibition-card">
        <div class="exhibition-card__image">
            @if (!empty($item['purchase_history']) && $showSoldState == true)
            <img src="{{ asset($item['image']) }}" alt="商品画像" class="exhibition-card__image-img image-img__sold">
            <p class="exhibition-card__image-sold">SOLD</p>
            @else
            <img src="{{ asset($item['image']) }}" alt="商品画像" class="exhibition-card__image-img">
            @endif
        </div>
        <p class="exhibition-card__name">{{ $item['name'] }}</p>
    </a>
    @endforeach
</div>