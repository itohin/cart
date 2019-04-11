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
                                    <td>
                                        <form action="{{ route('cart.update', [$item->slug]) }}" method="post" class="form-inline">
                                            {{ csrf_field() }}
                                            <select name="quantity" class="form-control input-sm">
                                                @for ($i = 1; $i <= $item->stock; $i++)
                                                    <option value="{{ $i }}"{{ $i == $item->quantity ? ' selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                                <option value="0">None</option>
                                            </select>

                                            <input type="submit" class="btn btn-default btn-sm" value="Update">
                                        </form>
                                    </td>
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