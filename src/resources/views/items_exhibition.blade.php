<div class="item-exhibition">
    @foreach ($items as $item)
    <a href="/item/{{ $item['id'] }}" class="exhibition-card">
        <div class="exhibition-card__image">
            <!-- 続きここから -->
            <img src="{{ asset($item['image']) }}" alt="商品画像" class="exhibition-card__image-img @if (!empty($item['purchase_history'] && $showSoldState == true) image-img__sold @endif">
            @if (!empty($item['purchase_history]) && $showSoldState == true)
            <p class="exhibition-card__image-sold">SOLD</p>
            @endif
        </div>
        <p class="exhibition-card__name">{{ $item['name'] }}</p>
    </a>
    @endforeach
</div>