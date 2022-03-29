@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Product Page</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Description</th>
                        <th>Price</th>
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
                            <td>{{ $value->brand }}</td>
                            <td>{{Str:: limit($value->description,50)}}</td>
                            <td>{{ $value->price }}</td>
                            <td>
                                <img src="{{ asset('assets/uploads/products/'.$value->image) }}" class="category-image" alt="Image here">
                            </td>
                            <td>
                                <a href="{{ url('edit-product/'.$value->id) }}" class="btn btn-sm">Edit</a>
                                <a href="{{ url('delete-product/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                <a href="{{ url('view-entry/'.$value->id) }}" class="btn btn-success btn-sm">View Entry</a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

