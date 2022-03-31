@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header text-white">
            <h2>Category</h2>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->description }}</td>
                            <td>
                                <img src="{{ asset('assets/uploads/category/'.$value->image) }}" class="category-image" alt="image">
                            </td>
                            <td>
                                <a href="{{ url('edit-category/'.$value->id) }}" class="btn">Edit</a>
                                <a href="{{ url('delete-category/'.$value->id) }}" class="btn btn-danger">Delete</a>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

