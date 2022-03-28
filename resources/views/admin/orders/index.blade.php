@extends('layouts.admin')
@section('title')
Orders
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class = "text-white">All Orders</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class = "table-primary">
                                <tr>
                                    <th>Order Date</th>
                                    <th>Order Number</th>
                                    <th>Tracking Number</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tracking_no }}</td>
                                        <td>{{ $item->total_amount }}</td>
                                        <td>{{ $item->status == '0' ?'processing' : 'shipped' }}</td>
                                        <td>
                                            <a href="{{ url('admin/view-order/'.$item->id) }}" >Edit Order Status</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
