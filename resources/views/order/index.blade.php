@extends('app')

@section('content')
    <form action="{{ route('order.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Your details</h3>
                        <hr>
                        <div class="form-group{{ ($errors->has('email')) ? ' has-error' : '' }}">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ ($errors->has('name')) ? ' has-error' : '' }}">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>Shipping address</h3>
                        <hr>
                        <div class="form-group{{ ($errors->has('address1')) ? ' has-error' : '' }}">
                            <label for="address1">Address Line 1</label>
                            <input type="text" name="address1" id="address1" class="form-control" value="{{ old('address1') }}">
                            @if ($errors->has('address1'))
                                <span class="help-block">
                                    {{ $errors->first('address1') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ ($errors->has('address2')) ? ' has-error' : '' }}">
                            <label for="address2">Address Line 2</label>
                            <input type="text" name="address2" id="address2" class="form-control" value="{{ old('address2') }}">
                            @if ($errors->has('address2'))
                                <span class="help-block">
                                    {{ $errors->first('address2') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ ($errors->has('city')) ? ' has-error' : '' }}">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
                            @if ($errors->has('city'))
                                <span class="help-block">
                                    {{ $errors->first('city') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ ($errors->has('postal_code')) ? ' has-error' : '' }}">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code') }}">
                            @if ($errors->has('postal_code'))
                                <span class="help-block">
                                    {{ $errors->first('postal_code') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="well">
                    <h4>Your Order</h4>
                    <hr>
                    @include('cart.partials.content')
                    @include('cart.partials.summary')

                    <button type="submit" class="btn btn-default">Place Order</button>
                </div>
            </div>
        </div>
    </form>
@endsection