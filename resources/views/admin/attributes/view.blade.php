@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header text-white">
            <h4>Entries</h4>
        </div>
        <hr>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                <tr>
                    <td>{{$entry->prod_id}}</td>
                    <td>{{$entry->product->name}}</td>
                    <td>{{$entry->size->size}}</td>
                    <td>{{$entry->color->color}}</td>
                    <td>{{$entry->qty}}</td>
                    <td>
                        <a href="{{ url('delete-entry/'.$entry->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{url('add-entry'}}" method="post">
            @csrf
                <!-- <label for="">Product</label>
                <select class="form-select" name="cate_id" >
                    <option value="">Select a product</option>
                    @foreach ($products as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                    @endforeach
                </select> -->
            <label for="">Size</label>
            <input name="prod_id" hidden value="{{$prod_id}}">
            <select name="size_id" class="form_select sizes" id="sizes">
                @foreach($sizes as $size)
                <option value="{{$size->id}}">{{$size->size}}</option>
                @endforeach
            </select>
            <label for="">Color</label>
            <select name="color_id" class="form_select sizes" id="colors">
                @foreach($colors as $color)
                <option value="{{$color->id}}">{{$size->color}}</option>
                @endforeach
            </select>
            <label for="quantity">Quantity</label>
            <input id="qty" type="number" name="qty">
            <button type="submit" class="btn btn-success btn-sm ml-3">Add Entry</button>
        </form>
        </div>
    </div>
@endsection