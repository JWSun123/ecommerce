@extends('layouts.front')

@section('title')
@if (@isset($products))
                {{$products[0]->category->name}}
@endif
@endsection

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>
                @if (@isset($products))
                {{$products[0]->category->name}}
                @endif
            </h2>
            @foreach ($products as $product)
                <div class="col-md-3">
                    <a href="{{ url('view-product/'.$product->id) }}">
                    <div class="card">
                        <img class = "product-image" src="{{ asset('assets/uploads/products/'.$product->image) }}" alt="Product image">
                        <div class="card-body">
                            <h5>{{ $product->name }}</h5>
                            <span class="float-start">{{ $product->price }}</span>
                            <span class="float-end">{{ $product->brand }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
