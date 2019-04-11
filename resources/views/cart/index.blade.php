@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if($basket->itemsCount() > 0)
                <div class="well">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($basket->all() as $item)
                                <tr>
                                    <td><a href="{{ route('products.show', [$item->slug]) }}">{{ $item->title }}</a></td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>You have no items in your cart. <a href="{{ route('home') }}">Start shopping</a></p>
            @endif
        </div>
        <div class="col-md-4">
            @if($basket->itemsCount() > 0 and $basket->subTotal())
                <div class="well">
                    <h4>Cart summary</h4>
                    <hr>

                    @include('cart.partials.summary')

                    <a href="#" class="btn btn-default">Checkout</a>
                </div>
            @endif
        </div>
    </div>
@endsection