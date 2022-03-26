@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header text-white">
            <h2>Update Product</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('update-product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Category</label>+
                        <select class="form-select">
                            <option value="">{{ $product->category->name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value = "{{$product->name}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Brand</label>
                        <input type="text" class="form-control" name="brand" value = "{{$product->brand}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control">{{$product->description}}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Price</label>
                        <input type="number" step = "0.01" class="form-control" name="price" value = "{{$product->price}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Quantity</label>
                        <input type="number" class="form-control" name="quantity" value = "{{$product->quantity}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" name="status" {{ $product->status == "1" ? 'checked' : '' }} >
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title" value = "{{$product->meta_title}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" rows="3" class="form-control">{{$product->meta_keywords}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_descrip" rows="3" class="form-control">{{$product->meta_descrip}}</textarea>
                    </div>
                    @if($product->image)
                        <img src="{{ asset('assets/uploads/products/'.$product->image) }}" alt="" class = category-image>
                    @endif
                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

