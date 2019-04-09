@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $product->image }}" alt="" class="thumbnail img-responsive">
        </div>
        <div class="col-md-8">
            <h3>{{ $product->title }}</h3>
            <p>{{ $product->description }}</p>
        </div>
    </div>
@endsection