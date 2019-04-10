@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $product->image }}" alt="" class="thumbnail img-responsive">
        </div>
        <div class="col-md-8">
            @if($product->hasLowStock())
                <span class="label label-warning">Low stock</span>
            @endif

                @if($product->outOfStock())
                    <span class="label label-danger">Out of stock</span>
                @endif

            <h3>{{ $product->title }}</h3>
            <p>{{ $product->description }}</p>

                @if($product->inStock())
                    <a href="{{ route('cart.add', [$product->slug, 1]) }}" class="btn btn-default btn-sm">Add to Cart</a>
                @endif
        </div>
    </div>
@endsection