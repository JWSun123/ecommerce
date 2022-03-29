@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header text-white">
            <h4>Entries</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Size</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sizes as $size)
                        <tr>
                            <td>{{ $size->id }}</td>
                            <td>{{ $size->size }}</td>
                            <td>
                                <a href="{{ url('delete-size/'.$size->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div>
                <form action = "{{ url('add-size') }}" method = "post">
                    @csrf
                    <input type="text" name="size">
                    <button type='submit' class="btn btn-success btn-sm ml-3">Add Size</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Color</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($colors as $color)
                        <tr>
                            <td>{{ $color->id }}</td>
                            <td>{{ $color->color }}</td>
                            <td>
                                <a href="{{ url('delete-color/'.$color->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <form action = "{{ url('add-color') }}" method = "post">
                @csrf
                <input type="text" name="color">
                <button type='submit' class="btn btn-success btn-sm ml-3">Add Color</button>
            </form>
        </div>
    </div>
@endsection

