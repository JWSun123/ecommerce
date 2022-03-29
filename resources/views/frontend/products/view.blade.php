@extends('layouts.front')

@section('title', $product->name)

@section('content')


<div class="py-3 mb-4 shadow-sm border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('category') }}">
                Collections
            </a> /
            <a href="{{ url('view-category/'.$product->category_id) }}">
                {{ $product->category->name }}
            </a> /
            <a href="{{ url('view-product/'.$product->id) }}">
                {{ $product->name }}
            </a>
         </h6>
    </div>
</div>

<div class="container pb-5">
    <div class=" product_data">
        <div class="">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img src="{{ asset('assets/uploads/products/'.$product->image) }}" class="w-100" alt="">
                </div>
                <div class="col-md-8">
                    <h2 class="mb-0">
                        {{ $product->name }}
                    </h2>
                    <hr>
                    <label class="fw-bold">Price: ${{ $product->price }}</label>
                    <hr>
                    <label for="">Size</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Choose a Size</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <label for="">Colour</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Choose a Color</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <hr>
                    @if($product->quantity > 0)
                        <label class="badge bg-info">In stock</label>
                    @else
                        <label class="badge bg-danger">Out of stock</label>
                    @endif
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <input type="hidden" value="{{ $product->id }}" class="prod_id">
                            <label for="Quantity">Quantity</label>
                            <div class="input-group text-center mb-3" style="width:130px;">
                                <button class="input-group-text decrement-btn">-</button>
                                <input type="text" name="quantity" class="form-control qty-input text-center" value="1" >
                                <button class="input-group-text increment-btn">+</button>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <br/>
                                <button type="button" @if($product->quantity <= 0) @disabled(true) @endif class="btn btn-primary me-3 addToCartBtn float-start">Add to Cart <span class="material-icons">
                                    add_shopping_cart
                                    </span></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <h3>Description</h3>
                    <p class="mt-3 ">
                        {{$product->description}}
                    </p>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>

@endsection
