@extends('layouts.front')

@section('title')
Order Detail
@endsection


@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="">Order Number: {{$order->id}}
                            <a href="{{ url('order-history') }}" class="btn btn-outline-primary float-end">Back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4>Shipping Information</h4>
                                <hr>
                                <label for="">Name</label>
                                <div class="border">{{ $order->name }}</div>
                                <label for="">Email</label>
                                <div class="border">{{ $order->email }}</div>
                                <label for="">Phone</label>
                                <div class="border">{{ $order->phone }}</div>
                                <label for="">Shipping Address</label>
                                <div class="border">
                                    {{ $order->address }}, {{ $order->apartment }}<br>
                                    {{ $order->city }},<br>
                                    {{ $order->province }},
                                    {{ $order->country }},
                                </div>
                                <label for="">Postal Code</label>
                                <div class="border">{{ $order->postalcode }}</div>
                            </div>
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                                <table class="table table-bordered table-hover">
                                    <thead class = "table-light">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderitems as $item)
                                            <tr>
                                                <td>{{ $item->entries->product->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ $item->entries->product->price }}</td>
                                                <td>
                                                    <img src="{{ asset('assets/uploads/products/'.$item->entries->product->image) }}" width="50px" alt="Product Image">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2">Total Amount: <span class="float-end">${{ $order->total_amount }}</span> </h4>
                                <h6 class="px-2">Payment Method: {{ $order->payment_mode == '1' ?'Credit Card' : 'Debit Card' }}</h6>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
