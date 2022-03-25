@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Product Page</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Selling Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->category->name }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->price }}</td>
                            <td>
                                <img src="{{ asset('assets/uploads/products/'.$value->image) }}" class="cate-image" alt="Image here">
                            </td>
                            <td>
                                <a href="{{ url('edit-product/'.$value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ url('delete-product/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
