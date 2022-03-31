@extends('layouts.front')

@section('title')
Ecommerce
@endsection

@section('content')
@include('layouts.inc.slider')

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="mb-4">
                <h2>Products</h2>
            </div>
            @foreach ($products as $product)
                <div class="col-md-2">
                    <a href="{{ url('view-product/'.$product->id) }}">
                        <div class="card zoom">
                            <img class = "product-image" src="{{ asset('assets/uploads/products/'.$product->image) }}" alt="Product image">
                            <div class="card-body">
                                <h5>{{ $product->name }}</h5>
                                <span class="float-start">${{ $product->price }}</span>
                                <span class="float-end">{{ $product->brand }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
