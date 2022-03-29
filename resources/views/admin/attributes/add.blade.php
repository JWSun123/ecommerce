@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header text-white">
            <h4>Add Attribute</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insert-attr')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Product</label>
                        <select class="form-select" name="cate_id" >
                            <option value="">Select a product</option>
                            @foreach ($products as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <select class="form-select" name="size_id" >
                            <option value="">Select a Size</option>
                            @foreach ($sizes as $row)
                                <option value="{{ $row->id }}">{{ $row->size }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <select class="form-select" name="color_id" >
                            <option value="">Select a Color</option>
                            @foreach ($colors as $row)
                                <option value="{{ $row->id }}">{{ $row->color }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">quantity</label>
                        <input type="text" class="form-control" name="quantity">
                    </div>
                
                
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection