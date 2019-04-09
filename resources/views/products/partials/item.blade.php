<div class="thumbnail">
    <a href="{{ route('products.show', [$product->slug]) }}"><img src="{{ $product->image }}" alt=""></a>
    <div class="caption">
        <h4><a href="{{ route('products.show', [$product->slug]) }}">{{ $product->title }}</a></h4>
        <p>{{ Str::words($product->description, 20) }}</p>
    </div>
</div>