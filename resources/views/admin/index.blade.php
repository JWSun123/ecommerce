@extends('layouts.admin')

@section('content')
<div class = "card">
    <div class="card-body mb-3">
        <h1>Ecommerce</h1>
    </div>
</div>
<div class="card">
    <div class="card-body mt-3">
        <h2>About us</h2>
        <form action = "{{ url('description') }}" method = "post">
            @csrf

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label>Description message:</label>
                    <textarea name="description" rows="3" class="form-control">@if(isset($description)){{$description->description}}@endif</textarea>
                    <div class="col-md-12 mt-1">
                        <button type="submit" class="btn btn-primary">Add/Edit</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
