@extends('layouts.front')

@section('title')
My Cart
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">
                Home
            </a> /
            <a href="{{ url('cart') }}">
                Cart
            </a>
         </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow cartitems">
        @if($cartItems->count() > 0)
            <div class="card-body">
                @php $total = 0; @endphp
                @foreach ($cartItems as $item)
                    <div class="row product_data">
                        <div class="col-md-2 my-auto">
                            <img src="{{ asset('assets/uploads/products/'.$item->entry->product->image) }}" height="70px" width="70px" alt="Image here">
                        </div>
                        <div class="col-md-2 my-auto">
                            <h6>{{ $item->entry->product->name }}</h6>
                        </div>

                        <div class="col-md-1 my-auto">
                            <h6>{{ $item->entry->size->size }}</h6>
                        </div>
                        <div class="col-md-1 my-auto">
                            <h6>{{ $item->entry->color->color }}</h6>
                        </div>

                        <div class="col-md-2 my-auto">
                            <h6> ${{ $item->entry->product->price }}</h6>
                        </div>
                        <div class="col-md-2 my-auto">
                            <input type="hidden" class="prod_id" value="{{ $item->entry_id }}">
                            @if( $item->entry->quantity >= $item->prod_qty)
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3" style="width:130px;">
                                    <button class="input-group-text changeQuantity decrement-btn">-</button>
                                    <input type="text" name="quantity" class="form-control qty-input text-center" value="{{ $item->prod_qty }}" >
                                    <button class="input-group-text changeQuantity increment-btn">+</button>
                                </div>
                                @php $total += $item->entry->product->price * $item->prod_qty ; @endphp
                            @else
                                <h6>Out of Stock</h6>
                            @endif
                        </div>
                        <div class="col-md-2 my-auto">
                            <button class="btn btn-danger delete-cart-item"> <i class="fa fa-trash"></i> Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <h5>Total Price : ${{ $total }}

                <a href="{{ url('checkout') }}" class="btn btn-outline-primary float-end">Proceed to Checkout</a>
                </h5>
            </div>
        @else
            <div class="card-body text-center">
                <h2>Your Cart is Empty</h2>
                <a href="{{ url('category') }}" class="btn btn-outline-primary float-end">Continue Shopping</a>
            </div>

        @endif
    </div>
</div>
@endsection
