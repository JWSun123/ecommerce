@extends('layouts.admin')

@section('title')
Order Detail
@endsection


@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h3 class="text-white">Order Number: {{$order->id}}
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
                                    <thead class = "table-primary">
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
                                                <td>{{ $item->price }}</td>
                                                <td>
                                                    <img src="{{ asset('assets/uploads/products/'.$item->entries->product->image) }}" width="50px" alt="Product Image">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2">Total Amount: <span class="float-end">{{ $order->total_amount }}</span> </h4>
                                <h6 class="px-2">Payment Method: {{ $order->payment_mode }}</h6>
                                <hr>
                                <div class = "mt-4">
                                    <label for=""><h4>Order Status</h4></label>
                                    <form action = "{{url('update-order/'.$order->id)}}" method = "post">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-select" name = "status">
                                            <option selected>Select Status</option>
                                            <option {{$order->status == '0'? 'selected':''}} value="0">Processing</option>
                                            <option value="1" {{$order->status == '1'? 'selected':''}}>Shipped</option>
                                        </select>
                                        <button type = "submit" class = "btn btn-primary mt-2">Update Status</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
