@extends('layouts.front')

@section('title')
Category
@endsection

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>All Categories</h2>
                <div class="row mt-3">
                    @foreach ($categories as $category)
                    <div class="col-md-3 mb-3">
                        <a href="{{ url('view-category/'.$category->id) }}">
                            <div class="card">
                                <img class = "product-image" src="{{ asset('assets/uploads/category/'.$category->image) }}" alt="category image">
                                <div class="card-body">
                                    <h5>{{ $category->name }}</h5>
                                    <p>{{$category->description}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
